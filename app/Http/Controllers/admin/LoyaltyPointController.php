<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoyaltyPoint;
use App\Models\User;
use Illuminate\Http\Request;

class LoyaltyPointController extends Controller
{
    public function index()
    {
        $loyaltyPoints = LoyaltyPoint::with('user')->paginate(20);
        return view('backend.loyalty.points.index', compact('loyaltyPoints'));
    }

    public function edit($id)
    {
        $loyaltyPoint = LoyaltyPoint::findOrFail($id);
        return view('backend.loyalty.points.edit', compact('loyaltyPoint'));
    }

    public function update(Request $request, $id)
    {
        $loyaltyPoint = LoyaltyPoint::findOrFail($id);

        $request->validate([
            'available_points' => 'required|integer|min:0',
        ]);

        $loyaltyPoint->update([
            'available_points' => $request->available_points,
            'points' => $request->available_points, // Syncing total points for simplicity if needed
        ]);

        return redirect()->route('admin.loyalty.points.index')->with('success', 'User points updated successfully.');
    }
}
