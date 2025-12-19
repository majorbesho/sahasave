<?php

namespace App\Services;

use App\Models\User;
use App\Models\PointTransaction;
use App\Exceptions\LimitExceededException;
use Illuminate\Support\Facades\Log;

class ValidationService
{
    /**
     * Validate if a user can earn specific points based on type and limits.
     * 
     * @param User $user
     * @param int $points
     * @param string $type
     * @throws LimitExceededException
     */
    public function validatePointTransaction(User $user, int $points, string $type)
    {
        // 1. Daily Limits Check
        $dailyLimit = $this->getDailyLimit($user->loyalty_tier);
        $dailyEarned = $this->getDailyEarned($user);

        if (($dailyEarned + $points) > $dailyLimit) {
            Log::warning("Transaction Limit: User {$user->id} exceeded daily limit ($dailyLimit).");
            throw new LimitExceededException('Daily point earning limit exceeded.');
        }

        // 2. Type-Specific Limits Check
        $typeLimit = config("loyalty.limits.{$type}", 0); // Default 0 means no specific limit? Or infinite?
        // Assuming > 0 means a limit exists.

        if ($typeLimit > 0) {
            $typeEarned = $this->getTypeEarned($user, $type);

            if (($typeEarned + $points) > $typeLimit) {
                Log::warning("Transaction Limit: User {$user->id} exceeded limit for type '$type' ($typeLimit).");
                throw new LimitExceededException("Earning limit for '{$point_trans_label}' exceeded.");
            }
        }
    }

    private function getDailyLimit($tierCode)
    {
        // Fetch from config based on tier, or default global limit
        // Example config structure: loyalty.tiers.gold.daily_limit
        // Or db stored in LoyaltyTier model

        // Let's assume a default hierarchy for now
        $limits = [
            'bronze' => 1000,
            'silver' => 2000,
            'gold' => 5000,
            'platinum' => 10000
        ];

        return $limits[$tierCode] ?? 1000;
    }

    private function getDailyEarned(User $user)
    {
        return PointTransaction::where('user_id', $user->id)
            ->where('direction', 'credit')
            ->whereDate('created_at', today())
            ->sum('points');
    }

    private function getTypeEarned(User $user, string $type)
    {
        // Assuming type limits are also DAILY? Or Lifetime?
        // Context suggests daily or monthly cap for specific activities (e.g. 5 reviews a day).
        // Let's assume DAILY for consistency with the first check.

        return PointTransaction::where('user_id', $user->id)
            ->where('type', $type)
            ->where('direction', 'credit')
            ->whereDate('created_at', today())
            ->sum('points');
    }
}
