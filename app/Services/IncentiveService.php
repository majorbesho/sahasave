<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class IncentiveService
{
    public function checkAndApplyIncentives(User $user, string $action)
    {
        $incentives = [
            'streak_incentives' => $this->checkStreakIncentives($user),
            'milestone_incentives' => $this->checkMilestoneIncentives($user),
            'seasonal_incentives' => $this->checkSeasonalIncentives($user),
            'behavioral_incentives' => $this->checkBehavioralIncentives($user, $action)
        ];

        foreach ($incentives as $type => $incentive) {
            if ($incentive) {
                $this->applyIncentive($user, $incentive);
            }
        }
    }

    private function checkStreakIncentives(User $user)
    {
        // مكافأة الاستمرارية
        // Assuming login_streak and appointment_streak are properties/attributes on User
        // These might be calculated or stored columns.

        if (($user->login_streak ?? 0) >= 7) {
            // Logic to ensure not already rewarded for this streak?
            // Usually we'd track 'last_streak_rewarded' or similar.
            // For now, returning definition.
            return ['type' => 'weekly_streak', 'points' => 100, 'description' => 'Weekly Login Streak'];
        }

        if (($user->appointment_streak ?? 0) >= 3) {
            return ['type' => 'appointment_streak', 'points' => 150, 'description' => '3 Consecutive Appointments'];
        }

        return null;
    }

    private function checkMilestoneIncentives(User $user)
    {
        // المعالم الرئيسية
        $milestones = [
            10 => 500,    // 10 مواعيد
            25 => 1500,   // 25 موعد
            50 => 3000,   // 50 موعد
            100 => 10000  // 100 موعد
        ];

        $completed = $user->completed_appointments ?? 0;

        foreach ($milestones as $count => $points) {
            if ($completed == $count) {
                return [
                    'type' => 'milestone',
                    'points' => $points,
                    'milestone' => $count,
                    'description' => "Milestone Reached: {$count} Appointments"
                ];
            }
        }

        return null;
    }

    private function checkSeasonalIncentives(User $user)
    {
        // Placeholder for seasonal logic (e.g., Ramadan, Holidays)
        // Checking config or active seasonal campaigns

        // Example: if today is National Day
        // if (now()->format('m-d') === '09-23') { ... }

        return null;
    }

    private function checkBehavioralIncentives(User $user, string $action)
    {
        // Rewards for specific actions not covered elsewhere
        if ($action === 'profile_completion' && $user->profile_completion_percentage >= 100) {
            return ['type' => 'profile_complete', 'points' => 200, 'description' => 'Complete Profile'];
        }

        if ($action === 'first_deposit') {
            return ['type' => 'first_deposit', 'points' => 50, 'description' => 'First Wallet Deposit'];
        }

        return null;
    }

    private function applyIncentive(User $user, array $incentive)
    {
        // Use User's earnPoints method
        if (method_exists($user, 'earnPoints')) {
            // Check if this specific incentive was already awarded recently/ever if needed
            // For simplicity, we assume the trigger (checkAndApply) controls frequency or earnPoints logs it.

            $user->earnPoints(
                $incentive['points'],
                'incentive_reward',
                null // Maybe pass an Incentive model if we had one, or null
            );

            Log::info("Incentive applied for user {$user->id}: {$incentive['type']}");
        }
    }
}
