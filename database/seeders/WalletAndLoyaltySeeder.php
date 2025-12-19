<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LoyaltyTier;
use App\Models\RewardProgram;
use App\Models\Voucher;

class WalletAndLoyaltySeeder extends Seeder
{
    public function run()
    {
        // مستويات الولاء
        $tiers = [
            [
                'name' => 'Bronze',
                'code' => 'bronze',
                'level' => 1,
                'min_points_required' => 0,
                'points_earning_rate' => 1.0,
                'points_expiry_days' => 365,
                'benefits' => [
                    'discount' => 5,
                    'priority_support' => false,
                    'birthday_bonus' => 100
                ],
                'badge_color' => '#CD7F32'
            ],
            [
                'name' => 'Silver',
                'code' => 'silver',
                'level' => 2,
                'min_points_required' => 1000,
                'points_earning_rate' => 1.2,
                'points_expiry_days' => 450,
                'benefits' => [
                    'discount' => 10,
                    'priority_support' => true,
                    'birthday_bonus' => 250,
                    'free_consultation' => 1
                ],
                'badge_color' => '#C0C0C0'
            ],
            [
                'name' => 'Gold',
                'code' => 'gold',
                'level' => 3,
                'min_points_required' => 5000,
                'points_earning_rate' => 1.5,
                'points_expiry_days' => 540,
                'benefits' => [
                    'discount' => 15,
                    'priority_support' => true,
                    'birthday_bonus' => 500,
                    'free_consultation' => 2,
                    'express_appointments' => true
                ],
                'badge_color' => '#FFD700'
            ],
            [
                'name' => 'Platinum',
                'code' => 'platinum',
                'level' => 4,
                'min_points_required' => 15000,
                'points_earning_rate' => 2.0,
                'points_expiry_days' => 730,
                'benefits' => [
                    'discount' => 20,
                    'priority_support' => true,
                    'birthday_bonus' => 1000,
                    'free_consultation' => 4,
                    'express_appointments' => true,
                    'dedicated_support' => true
                ],
                'badge_color' => '#E5E4E2'
            ]
        ];

        foreach ($tiers as $tier) {
            LoyaltyTier::updateOrCreate(['code' => $tier['code']], $tier);
        }

        // برامج المكافآت
        $programs = [
            [
                'name' => 'برنامج الإحالة للمرضى',
                'code' => 'PATIENT_REFERRAL',
                'type' => 'referral',
                'target_audience' => 'patients',
                'reward_structure' => [
                    'referrer_points' => 500,
                    'referee_points' => 300,
                    'cash_bonus' => 50
                ],
                'points_reward' => 500,
                'start_date' => now(),
                'end_date' => now()->addYear(),
                'is_active' => true
            ],
            [
                'name' => 'برنامج الولاء للمواعيد',
                'code' => 'APPOINTMENT_LOYALTY',
                'type' => 'loyalty',
                'target_audience' => 'patients',
                'reward_structure' => [
                    'points_per_appointment' => 100,
                    'bonus_after_5_appointments' => 500
                ],
                'points_reward' => 100,
                'start_date' => now(),
                'end_date' => now()->addYear(),
                'is_active' => true
            ]
        ];

        foreach ($programs as $program) {
            RewardProgram::updateOrCreate(['code' => $program['code']], $program);
        }

        // قسائم افتراضية
        $vouchers = [
            [
                'code' => 'WELCOME100',
                'name' => 'قسيمة ترحيب',
                'type' => 'discount',
                'discount_type' => 'percentage',
                'discount_value' => 10,
                'valid_from' => now(),
                'valid_to' => now()->addMonth(),
                'usage_limit' => 1000,
                'applicable_services' => ['consultation', 'follow_up']
            ],
            [
                'code' => 'POINTS500',
                'name' => 'خصم 500 نقطة',
                'type' => 'discount',
                'discount_type' => 'fixed',
                'discount_value' => 5,
                'points_required' => 500,
                'valid_from' => now(),
                'valid_to' => now()->addYear(),
                'user_usage_limit' => 5
            ]
        ];

        foreach ($vouchers as $voucher) {
            Voucher::updateOrCreate(['code' => $voucher['code']], $voucher);
        }
    }
}
