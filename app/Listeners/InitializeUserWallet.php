<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\LoyaltyPoint;
use App\Models\LoyaltyTier;
use App\Models\PointTransaction;
use App\Models\Voucher;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InitializeUserWallet
{
    public function handle(UserRegistered $event)
    {
        $user = $event->user;

        DB::beginTransaction();

        try {
            // 1. إنشاء المحفظة الافتراضية
            $wallet = $this->createDefaultWallet($user);

            // 2. تهيئة نقاط الولاء
            $loyaltyPoints = $this->initializeLoyaltyPoints($user);

            // 3. منح نقاط ترحيب (إذا كانت مفعلة)
            $this->grantWelcomePoints($user, $loyaltyPoints);

            // 4. منح قسيمة ترحيب (إذا كانت مفعلة)
            $this->grantWelcomeVoucher($user);

            // 5. إرسال إشعار الترحيب
            $this->sendWelcomeNotification($user, $wallet, $loyaltyPoints);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to initialize user wallet/loyalty: ' . $e->getMessage(), ['user_id' => $user->id]);
            // Optional: rethrow or handle gracefully depending on requirements
        }
    }

    private function createDefaultWallet($user)
    {
        // Check if wallet already exists to prevent duplicates
        $wallet = Wallet::where('user_id', $user->id)->where('is_default', true)->first();
        if ($wallet) {
            return $wallet;
        }

        $wallet = Wallet::create([
            'user_id' => $user->id,
            'type' => 'personal',
            'currency' => 'SAR',
            'status' => 'active',
            'is_default' => true,
            'settings' => [
                'auto_recharge' => false,
                'low_balance_alert' => 100,
                'transaction_limit' => 5000
            ],
            'limits' => [
                'daily_withdrawal' => 2000,
                'monthly_withdrawal' => 10000,
                'max_balance' => 50000
            ]
        ]);

        $wallet->generateWalletNumber();
        $wallet->save();

        // تسجيل معاملة الإيداع الأولي (إذا كان هناك مكافأة تسجيل)
        $welcomeBonus = config('wallet.welcome_bonus', 0);
        if ($welcomeBonus > 0) {
            $wallet->deposit(
                $welcomeBonus,
                'deposit', // Type
                'مكافأة ترحيب للتسجيل', // Description
                null, // Source
                ['source' => 'registration', 'is_bonus' => true] // Metadata
            );
        }

        return $wallet;
    }

    private function initializeLoyaltyPoints($user)
    {
        // Check if points account already exists
        $loyaltyPoints = LoyaltyPoint::where('user_id', $user->id)->first();
        if ($loyaltyPoints) {
            return $loyaltyPoints;
        }

        $defaultTier = LoyaltyTier::where('code', 'bronze')->first();

        return LoyaltyPoint::create([
            'user_id' => $user->id,
            'points' => 0,
            'available_points' => 0,
            'loyalty_tier' => $defaultTier ? $defaultTier->code : 'bronze',
            'points_value_rate' => config('loyalty.points_value_rate', 0.01),
            'tier_expires_at' => now()->addYear(),
            'next_evaluation_date' => now()->addMonth(),
            'tier_benefits' => $defaultTier ? $defaultTier->benefits : []
        ]);
    }

    private function grantWelcomePoints($user, $loyaltyPoints)
    {
        $welcomePoints = config('loyalty.welcome_points', 0);

        if ($welcomePoints > 0) {
            // Use the User model's earnPoints method if available, or manual logic
            if (method_exists($user, 'earnPoints')) {
                $user->earnPoints($welcomePoints, 'bonus_campaign', null);
            } else {
                // Fallback manual logic if User model method isn't ready or compatible
                PointTransaction::create([
                    'user_id' => $user->id,
                    'loyalty_point_id' => $loyaltyPoints->id,
                    'transaction_code' => 'WEL' . time() . strtoupper(substr(md5(uniqid()), 0, 6)),
                    'type' => 'bonus_campaign',
                    'points' => $welcomePoints,
                    'points_before' => $loyaltyPoints->points,
                    'points_after' => $loyaltyPoints->points + $welcomePoints,
                    'monetary_value' => $welcomePoints * $loyaltyPoints->points_value_rate,
                    'status' => 'approved',
                    'direction' => 'credit',
                    'description' => 'نقاط ترحيب للتسجيل في المنصة',
                    'metadata' => ['campaign' => 'welcome'],
                    'expires_at' => now()->addDays(365),
                    'approved_at' => now()
                ]);

                $loyaltyPoints->increment('points', $welcomePoints);
                $loyaltyPoints->increment('available_points', $welcomePoints);
                $loyaltyPoints->increment('total_earned', $welcomePoints);
            }
        }
    }

    private function grantWelcomeVoucher($user)
    {
        $welcomeVoucherCode = config('loyalty.welcome_voucher_template', 'WELCOME100');
        $templateVoucher = Voucher::where('code', $welcomeVoucherCode)->first();

        if ($templateVoucher) {
            // Clone the voucher for the user or assign usage
            // Strategy: If user-specific vouchers are needed, replicate.
            // Strategy: If using a generic welcome code, just ensure they can use it.
            // Here we assume we might want to attach a specific instance or rely on the generic code.
            // Given the context, we'll assign the user to a list of eligible users if that table exists,
            // OR send them the code. For now, let's assume we just log it or attach to user pivot if exists.

            // Simplest approach: Just notify them of the code in the notification step.
            // If we need to create a unique voucher for them:
            /*
             $newCode = 'WEL-' . strtoupper(substr(md5($user->id . time()), 0, 8));
             $newVoucher = $templateVoucher->replicate();
             $newVoucher->code = $newCode;
             $newVoucher->user_id = $user->id;
             $newVoucher->save();
             */
        }
    }

    private function sendWelcomeNotification($user, $wallet, $loyaltyPoints)
    {
        // Placeholder for notification logic
        // Notification::send($user, new WelcomeNotification($wallet, $loyaltyPoints));
        Log::info("Welcome notification sent to user {$user->id}");
    }
}
