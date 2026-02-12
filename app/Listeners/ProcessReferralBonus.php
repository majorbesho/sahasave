<?php

namespace App\Listeners;

use App\Events\ReferralCompleted;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Log;

class ProcessReferralBonus
{
    public function handle(ReferralCompleted $event)
    {
        $referral = $event->referral;
        $referrer = $referral->referrer;
        $referee = $referral->referred; // Assuming relationship is 'referred' or 'referee'

        if (!$referrer || !$referee) {
            return;
        }

        // 1. منح نقاط للمُحيل (Referrer Points)
        if (method_exists($referrer, 'earnPoints')) {
            $referrer->earnPoints(
                config('loyalty.points_per_referral', 500),
                'earn_referral',
                $referral
            );
        }

        // 2. منح نقاط للمُحال (Referee Points)
        if (method_exists($referee, 'earnPoints')) {
            $referee->earnPoints(
                config('loyalty.points_for_referee', 300),
                'earn_referral',
                $referral
            );
        }

        // 3. تحديث عداد الإحالات (Update Stats)
        $referrer->increment('referral_count');

        // 4. تحديث المستوى (Update Tier)
        if (method_exists($referrer, 'updateReferralTier')) {
            $referrer->updateReferralTier();
        }

        // 5. منح مكافأة نقدية (Cash Bonus)
        if (config('loyalty.referral_cash_bonus_enabled', false)) {
            $this->awardCashBonus($referrer, $referral);
        }

        Log::info("Referral Bonus Processed for Referral #{$referral->id}");
    }

    private function awardCashBonus(User $user, $referral)
    {
        $amount = config('loyalty.referral_cash_amount', 50);
        $wallet = $user->defaultWallet ?? $user->createDefaultWallet();

        $wallet->deposit(
            $amount,
            'referral_bonus',
            'Referral Bonus for ID #' . $referral->id,
            $referral
        );

        // Update user total referral earnings
        $user->increment('total_referral_earnings', $amount);
    }
}
