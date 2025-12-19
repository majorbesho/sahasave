<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\PointTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoyaltyController extends Controller
{
    /**
     * Display the loyalty dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Ensure user has loyalty points initialized
        $loyaltyPoints = $user->initializeLoyaltyPoints();

        // Get recent transactions
        $transactions = $user->pointTransactions()
            ->latest()
            ->take(5)
            ->get();

        // Get stats for dashboard
        $stats = $user->getLoyaltyDashboardStats();

        // Check if `frontend.patient.loyalty.index` exists, otherwise create it
        // For this step I am just returning the view assuming it will be created next
        return view('patient.loyalty.index', compact('user', 'loyaltyPoints', 'transactions', 'stats'));
    }

    /**
     * Display the transaction history.
     */
    public function history()
    {
        $user = Auth::user();

        $transactions = $user->pointTransactions()
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('patient.loyalty.history', compact('user', 'transactions'));
    }
}
