<?php

namespace App\Services;

use App\Models\User;
use App\Models\PointTransaction;
use App\Models\PointRedemption;
use App\Models\LoyaltyPoint;
use App\Models\LoyaltyTier;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportingService
{
    public function getLoyaltyReport($period = 'monthly')
    {
        return [
            'summary' => [
                'total_users' => User::count(),
                'active_users' => User::where('status', 'active')->count(),
                'total_points_issued' => PointTransaction::where('direction', 'credit')->sum('points'),
                'total_points_redeemed' => PointRedemption::sum('points_used'),
                'redemption_rate' => $this->calculateRedemptionRate()
            ],

            'tier_distribution' => $this->getTierDistribution(),

            'earning_sources' => $this->getEarningSources($period),

            'top_performers' => $this->getTopPerformers($period),

            'financial_impact' => [
                'total_value_issued' => $this->calculateTotalValueIssued(),
                'total_value_redeemed' => $this->calculateTotalValueRedeemed(),
                'outstanding_liability' => $this->calculateOutstandingLiability()
            ]
        ];
    }

    private function calculateRedemptionRate()
    {
        $totalIssued = PointTransaction::where('direction', 'credit')->sum('points');
        $totalRedeemed = PointRedemption::sum('points_used');

        if ($totalIssued == 0) return 0;

        return round(($totalRedeemed / $totalIssued) * 100, 2);
    }

    private function getTierDistribution()
    {
        // Group users by loyalty tier
        // Loyalty tier is stored in loyalty_points table usually, or denormalized on user.
        // Assuming denormalized on User based on previous 'User' model interactions (getLoyaltyTierAttribute),
        // or strictly on LoyaltyPoint model.
        // Safest is LoyaltyPoint.

        return LoyaltyPoint::select('loyalty_tier', DB::raw('count(*) as count'))
            ->groupBy('loyalty_tier')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->loyalty_tier => $item->count];
            });
    }

    private function getEarningSources($period)
    {
        $query = PointTransaction::select('type', DB::raw('sum(points) as total'))
            ->where('direction', 'credit');

        $this->applyPeriodFilter($query, $period);

        return $query->groupBy('type')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->type => $item->total];
            });
    }

    private function getTopPerformers($period, $limit = 10)
    {
        $query = PointTransaction::select('user_id', DB::raw('sum(points) as total_earned'))
            ->where('direction', 'credit')
            ->with('user:id,name,email'); // Eager load minimal user info

        $this->applyPeriodFilter($query, $period);

        return $query->groupBy('user_id')
            ->orderByDesc('total_earned')
            ->take($limit)
            ->get();
    }

    private function calculateTotalValueIssued()
    {
        return PointTransaction::where('direction', 'credit')->sum('monetary_value');
    }

    private function calculateTotalValueRedeemed()
    {
        return PointRedemption::sum('monetary_value');
    }

    private function calculateOutstandingLiability()
    {
        // Liability = Points in circulation * Value per point
        // If value varies per user, we need to sum specific liabilities.
        // If simplified: sum(loyalty_points.points * loyalty_points.rate)

        // Let's assume dynamic sum for accuracy
        return LoyaltyPoint::join('users', 'loyalty_points.user_id', '=', 'users.id')
            ->sum(DB::raw('loyalty_points.points * loyalty_points.points_value_rate'));
    }

    private function applyPeriodFilter($query, $period)
    {
        if ($period === 'monthly') {
            $query->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year);
        } elseif ($period === 'weekly') {
            $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($period === 'yearly') {
            $query->whereYear('created_at', now()->year);
        }
        // 'all' or default falls through with no filter
    }
}
