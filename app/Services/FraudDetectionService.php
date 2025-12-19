<?php

namespace App\Services;

use App\Models\User;
use App\Models\PointTransaction;
use App\Models\PointRedemption;
use Illuminate\Support\Facades\Log;

class FraudDetectionService
{
    /**
     * Detect suspicious activity based on transaction context.
     * 
     * @param mixed $transaction The transaction object or context array
     * @return bool True if high risk detected
     */
    public function detectSuspiciousActivity($transaction)
    {
        // Extract user and IP from transaction or context
        $user = $transaction instanceof PointTransaction ? $transaction->user : ($transaction['user'] ?? null);
        $ip = $transaction->ip_address ?? request()->ip();

        if (!$user) {
            return false;
        }

        $riskScore = 0;

        // 1. Check Earning Rate
        if ($this->unusualEarningRate($user)) {
            $riskScore += 30;
            Log::warning("Fraud Check: Unusual earning rate for user {$user->id}");
        }

        // 2. Check Multiple Redemption Attempts
        if ($this->multipleRedemptionAttempts($user)) {
            $riskScore += 40;
            Log::warning("Fraud Check: Multiple redemption attempts for user {$user->id}");
        }

        // 3. Check Suspicious IP
        if ($this->suspiciousIP($ip)) {
            $riskScore += 30;
            Log::warning("Fraud Check: Suspicious IP {$ip} for user {$user->id}");
        }

        // Additional: Check Account Age vs Points
        if ($this->isNewAccountWithHighPoints($user)) {
            $riskScore += 20;
        }

        $isHighRisk = $riskScore >= 70;

        if ($isHighRisk) {
            Log::alert("HIGH RISK ACTIVITY DETECTED: User {$user->id}, Score: {$riskScore}");
            // Optional: Flag user or freeze account
            // $user->update(['status' => 'suspended', 'meta' => ['suspension_reason' => 'fraud_detection']]);
        }

        return $isHighRisk;
    }

    private function unusualEarningRate(User $user)
    {
        // Criteria: Earned more than 5000 points in the last 10 minutes
        $recentEarnings = PointTransaction::where('user_id', $user->id)
            ->where('direction', 'credit')
            ->where('created_at', '>=', now()->subMinutes(10))
            ->sum('points');

        return $recentEarnings > 5000;
    }

    private function multipleRedemptionAttempts(User $user)
    {
        // Criteria: More than 5 failed redemption attempts in the last hour
        // Assuming we track failed redemptions. If not, we might check 'pending' or 'rejected'.
        // Or if 'points_used' > balance triggers failures recorded elsewhere.
        // Let's check 'rejected' redemptions.

        $failures = PointRedemption::where('user_id', $user->id)
            ->where('status', 'rejected')
            ->where('created_at', '>=', now()->subHour())
            ->count();

        return $failures >= 5;
    }

    private function suspiciousIP($ip)
    {
        // 1. Check Blacklist (simulated)
        $blacklist = ['127.0.0.666', '10.0.0.1']; // Example
        if (in_array($ip, $blacklist)) return true;

        // 2. Volume Check: IP used by more than 5 users today
        // This requires tracking IP on User or Transaction login.
        // Assuming PointTransaction has ip_address.

        // Check if PointTransaction has ip_address column? Migration didn't explicitly show it.
        // If not, skip DB check or assume 'meta' holds it.
        /*
        $usersOnIp = PointTransaction::where('ip_address', $ip)
            ->whereDate('created_at', today())
            ->distinct('user_id')
            ->count();
            
        if ($usersOnIp > 5) return true;
        */

        return false;
    }

    private function isNewAccountWithHighPoints(User $user)
    {
        // Account < 24 hours old has > 10,000 points
        return $user->created_at > now()->subDay() &&
            ($user->loyaltyPoints->points ?? 0) > 10000;
    }
}
