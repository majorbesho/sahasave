<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoyaltyTier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoyaltyTierController extends Controller
{
    public function index()
    {
        $tiers = LoyaltyTier::orderBy('level')->get();
        return view('backend.loyalty.tiers.index', compact('tiers'));
    }

    public function create()
    {
        return view('backend.loyalty.tiers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:loyalty_tiers,code',
            'level' => 'required|integer|unique:loyalty_tiers,level',
            'min_points_required' => 'required|integer',
            'points_earning_rate' => 'required|numeric',
        ]);

        $data = $request->all();
        $data['benefits'] = $request->benefits ? json_decode($request->benefits, true) : [];
        $data['perks'] = $request->perks ? json_decode($request->perks, true) : [];

        LoyaltyTier::create($data);

        return redirect()->route('admin.loyalty.tiers.index')->with('success', 'Loyalty Tier created successfully.');
    }

    public function edit(LoyaltyTier $tier)
    {
        return view('backend.loyalty.tiers.edit', compact('tier'));
    }

    public function update(Request $request, LoyaltyTier $tier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:loyalty_tiers,code,' . $tier->id,
            'level' => 'required|integer|unique:loyalty_tiers,level,' . $tier->id,
            'min_points_required' => 'required|integer',
            'points_earning_rate' => 'required|numeric',
        ]);

        $data = $request->all();
        $data['benefits'] = $request->benefits ? json_decode($request->benefits, true) : [];
        $data['perks'] = $request->perks ? json_decode($request->perks, true) : [];

        $tier->update($data);

        return redirect()->route('admin.loyalty.tiers.index')->with('success', 'Loyalty Tier updated successfully.');
    }

    public function destroy(LoyaltyTier $tier)
    {
        $tier->delete();
        return redirect()->route('admin.loyalty.tiers.index')->with('success', 'Loyalty Tier deleted successfully.');
    }
}
