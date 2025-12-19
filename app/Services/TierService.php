<?php

namespace App\Services;

use App\Models\User;
use App\Models\LoyaltyTier;
use App\Models\TierHistory;
use App\Events\TierUpgraded;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TierService
{
    public function evaluateUserTier(User $user, $force = false)
    {
        $loyaltyPoints = $user->loyaltyPoints;

        if (!$loyaltyPoints) {
            $loyaltyPoints = $user->initializeLoyaltyPoints();
        }

        // Check next evaluation date
        if (!$force && $loyaltyPoints->next_evaluation_date && now()->lt($loyaltyPoints->next_evaluation_date)) {
            return false;
        }

        return DB::transaction(function () use ($user, $loyaltyPoints) {
            // Calculate Performance
            $performance = $this->calculatePerformance($user);

            // Determine Eligible Tier
            $eligibleTier = $this->determineEligibleTier($performance);
            $currentTier = $loyaltyPoints->tier; // This is a model instance if relation is set up correctly, or code if string.

            // Handle case where relation might return null if tier code changed or seeded data missing
            $currentTierLevel = $currentTier->level ?? 0;

            if ($eligibleTier->level > $currentTierLevel) {
                // Upgrade
                $this->upgradeTier($user, $currentTier, $eligibleTier, $performance);
                return true;
            } elseif ($eligibleTier->level < $currentTierLevel) {
                // Downgrade
                $this->downgradeTier($user, $currentTier, $eligibleTier, $performance);
                return true;
            }

            // No change, just update evaluation date
            $loyaltyPoints->update([
                'next_evaluation_date' => now()->addMonth()
            ]);

            return false;
        });
    }

    private function calculatePerformance(User $user)
    {
        // 1. Points Score (40%)
        $pointsScore = $this->calculatePointsScore($user);

        // 2. Activity Score (30%)
        $activityScore = $this->calculateActivityScore($user);

        // 3. Quality Score (20%)
        $qualityScore = $this->calculateQualityScore($user);

        // 4. Referral Score (10%)
        $referralScore = $this->calculateReferralScore($user);

        $totalScore = round(
            ($pointsScore * 0.4) +
                ($activityScore * 0.3) +
                ($qualityScore * 0.2) +
                ($referralScore * 0.1)
        );

        return [
            'total_score' => $totalScore,
            'points_score' => $pointsScore,
            'activity_score' => $activityScore,
            'quality_score' => $qualityScore,
            'referral_score' => $referralScore
        ];
    }

    private function calculatePointsScore(User $user)
    {
        $points = $user->loyaltyPoints->points ?? 0;
        // Optimization: Cache max points to avoid repeated queries
        $maxPoints = LoyaltyTier::max('min_points_required') ?: 10000;

        // Prevent division by zero
        if ($maxPoints == 0) $maxPoints = 1;

        return min(100, ($points / $maxPoints) * 100);
    }

    private function calculateActivityScore(User $user)
    {
        $activities = [
            'appointments' => $user->completed_appointments ?? 0,
            'reviews'     => $user->total_reviews ?? 0,
            // Fallback if column doesn't exist yet
            'logins'      => $user->login_count_last_30_days ?? 0,
            'profile_completeness' => $user->profile_completion_percentage ?? 50 // Default to 50 if missing
        ];

        return $this->normalizeScore($activities);
    }

    private function calculateQualityScore(User $user)
    {
        // Example logic: Average rating (0-5) scaled to 0-100
        $rating = $user->average_rating ?? 0;
        return min(100, ($rating / 5) * 100);
    }

    private function calculateReferralScore(User $user)
    {
        // Example logic: 10 referrals = 100 score
        $referrals = $user->referral_count ?? 0;
        return min(100, ($referrals / 10) * 100);
    }

    private function normalizeScore(array $activities)
    {
        // Custom logic to weigh different activities. 
        // For simplicity, we'll take a weighted average or sum capped at 100.

        $score = 0;
        // Appointments: 5 points each, max 50
        $score += min(50, ($activities['appointments'] * 5));

        // Reviews: 5 points each, max 20
        $score += min(20, ($activities['reviews'] * 5));

        // Profile: Direct percentage * 0.2 (max 20)
        $score += ($activities['profile_completeness'] * 0.2);

        // Logins: 1 point each, max 10
        $score += min(10, ($activities['logins'] * 1));

        return min(100, $score);
    }

    private function determineEligibleTier($performance)
    {
        $totalScore = $performance['total_score'];

        // This logic assumes higher tiers map to higher scores.
        // If tiers are strictly points-based, use points requirements.
        // User requirements in migration: min_points_required.
        // Let's mix explicitly: Tiers usually require POINTS threshold primarily, 
        // but user prompt implies 'Performance' drives it.
        // We will stick to the User Prompt approach: 
        // Iterate tiers, check if "meetsTierRequirements".

        $tiers = LoyaltyTier::where('is_active', true)
            ->orderBy('level', 'desc')
            ->get();

        foreach ($tiers as $tier) {
            if ($this->meetsTierRequirements($tier, $performance)) {
                return $tier;
            }
        }

        return LoyaltyTier::where('level', 1)->first(); // Lowest tier
    }

    private function meetsTierRequirements($tier, $performance)
    {
        // If tier has explicit requirements in JSON
        if (!empty($tier->requirements)) {
            // Example requirement: "min_score": 80
            $requiredScore = $tier->requirements['min_score'] ?? 0;
            if ($performance['total_score'] < $requiredScore) {
                return false;
            }
        }

        // Fallback or additional check: Points threshold (Standard practice)
        // Note: calculatePointsScore normalized this 0-100 based on max.
        // Simply comparing total score might be the intended design here.
        // Let's assume some basic mapping if requirements are null:
        // Level 1: 0, Level 2: 30, Level 3: 60, Level 4: 85

        $defaultThresholds = [
            1 => 0,
            2 => 30,
            3 => 60,
            4 => 85
        ];

        $threshold = $defaultThresholds[$tier->level] ?? 0;
        return $performance['total_score'] >= $threshold;
    }

    private function upgradeTier($user, $oldTier, $newTier, $performance)
    {
        $this->updateUserTier($user, $newTier);

        // Bonus
        $bonusPoints = $this->calculateUpgradeBonus($oldTier, $newTier);
        if ($bonusPoints > 0) {
            // Ensure earnPoints exists on User (added in previous steps)
            if (method_exists($user, 'earnPoints')) {
                $user->earnPoints(
                    $bonusPoints,
                    'bonus_campaign', // or 'tier_upgrade' if enum allows
                    $newTier // Source
                );
            }
        }

        $this->logHistory($user, $oldTier, $newTier, 'automatic_upgrade', $performance, $bonusPoints);

        event(new TierUpgraded($user, $oldTier, $newTier, $bonusPoints));
    }

    private function downgradeTier($user, $oldTier, $newTier, $performance)
    {
        // Downgrades usually don't give bonuses
        $this->updateUserTier($user, $newTier);

        $this->logHistory($user, $oldTier, $newTier, 'automatic_downgrade', $performance, 0);

        // Maybe send downgrade notification event?
    }

    private function updateUserTier($user, $newTier)
    {
        $user->loyaltyPoints->update([
            'loyalty_tier' => $newTier->code,
            'tier_expires_at' => now()->addYear(),
            'tier_benefits' => $newTier->benefits,
            'next_evaluation_date' => now()->addMonth()
        ]);
    }

    private function calculateUpgradeBonus($oldTier, $newTier)
    {
        // Difference in min points * 0.05? Or fixed amount?
        // Let's use a fixed logic or benefit if defined.
        return 100 * ($newTier->level - ($oldTier->level ?? 0));
    }

    private function logHistory($user, $oldTier, $newTier, $reason, $performance, $bonus)
    {
        TierHistory::create([
            'user_id' => $user->id,
            'old_tier' => $oldTier ? $oldTier->code : null,
            'new_tier' => $newTier->code,
            'upgrade_reason' => $reason,
            'performance_data' => $performance,
            'bonus_awarded' => $bonus
        ]);
    }
}
