<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoyaltyController extends Controller
{
    /**
     * Get user loyalty summary
     */
    public function points()
    {
        $user = Auth::user();

        $transactions = [];
        if (method_exists($user, 'pointTransactions')) {
            $transactions = $user->pointTransactions()->latest()->take(10)->get();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'available_points' => $user->available_points ?? 0,
                'lifetime_points' => $user->lifetime_points ?? 0,
                'tier' => $user->loyalty_tier ?? 'Bronze',
                'recent_transactions' => $transactions
            ]
        ]);
    }

    /**
     * Get user loyalty tier details
     */
    public function tier()
    {
        $user = Auth::user();

        return response()->json([
            'success' => true,
            'data' => [
                'current_tier' => $user->loyalty_tier ?? 'Bronze',
                'points_to_next_tier' => 500, // Placeholder
                'benefits' => [
                    '5% discount on all consultations',
                    'Priority support'
                ]
            ]
        ]);
    }

    /**
     * Get available rewards to redeem
     */
    public function rewards()
    {
        // This would typically fetch from a RewardCatalog or similar
        // For now, return active rewards for the user
        $rewards = Auth::user()->rewards()->active()->get();

        return response()->json([
            'success' => true,
            'data' => $rewards
        ]);
    }

    /**
     * Redeem points for a reward
     */
    public function redeem(Request $request)
    {
        $request->validate([
            'reward_catalog_id' => 'required|integer', // Assuming a catalog exists
        ]);

        $user = Auth::user();

        // This logic would involve checking if user has enough points
        // and creating a new Reward record for the user.
        // Placeholder implementation:

        return response()->json([
            'success' => true,
            'message' => 'Reward redeemed successfully',
            'data' => [
                'points_deducted' => 100,
                'new_balance' => ($user->available_points ?? 0) - 100
            ]
        ]);
    }
}
