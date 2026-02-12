<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoyaltySetting;
use Illuminate\Http\Request;

class LoyaltySettingsController extends Controller
{
    public function index()
    {
        $settings = LoyaltySetting::all()->groupBy('group');
        return view('backend.loyalty.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($request->settings as $key => $value) {
            LoyaltySetting::set($key, $value);
        }

        return redirect()->back()->with('success', 'Loyalty settings updated successfully.');
    }
}
