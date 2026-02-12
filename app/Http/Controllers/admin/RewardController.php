<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    /**
     * Display a listing of rewards.
     */
    public function index(Request $request)
    {
        $query = Reward::with('user');

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('code', 'like', '%' . $request->search . '%');
            });
        }

        $rewards = $query->latest()->paginate(20);

        return view('backend.rewards.index', compact('rewards'));
    }

    /**
     * Show the form for creating a new reward.
     */
    public function create()
    {
        $users = User::whereIn('role', ['patient', 'doctor'])
            ->orderBy('name')
            ->get();

        return view('backend.rewards.create', compact('users'));
    }

    /**
     * Store a newly created reward in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:cashback,discount,bonus_points,free_consultation,voucher',
            'discount_type' => 'required_if:type,discount|nullable|in:percentage,fixed',
            'discount_value' => 'required_if:type,discount|nullable|numeric|min:0',
            'cashback_amount' => 'required_if:type,cashback|nullable|numeric|min:0',
            'bonus_points' => 'required_if:type,bonus_points|nullable|integer|min:0',
            'expires_at' => 'nullable|date|after_or_equal:today',
            'usage_limit' => 'nullable|integer|min:1',
            'min_consultation_value' => 'nullable|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
        ]);

        $validated['source_type'] = Reward::SOURCE_MANUAL;
        $validated['status'] = Reward::STATUS_ACTIVE;
        $validated['issued_at'] = now();
        $validated['code'] = Reward::generateCode('ADM');

        Reward::create($validated);

        return redirect()->route('admin.rewards.index')
            ->with('success', 'Reward created successfully');
    }

    /**
     * Show the form for editing the specified reward.
     */
    public function edit($id)
    {
        $reward = Reward::with('user')->findOrFail($id);

        $users = User::whereIn('role', ['patient', 'doctor'])
            ->orderBy('name')
            ->get();

        return view('backend.rewards.edit', compact('reward', 'users'));
    }

    /**
     * Update the specified reward in storage.
     */
    public function update(Request $request, $id)
    {
        $reward = Reward::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:cashback,discount,bonus_points,free_consultation,voucher',
            'discount_type' => 'required_if:type,discount|nullable|in:percentage,fixed',
            'discount_value' => 'required_if:type,discount|nullable|numeric|min:0',
            'cashback_amount' => 'required_if:type,cashback|nullable|numeric|min:0',
            'bonus_points' => 'required_if:type,bonus_points|nullable|integer|min:0',
            'expires_at' => 'nullable|date|after_or_equal:today',
            'usage_limit' => 'nullable|integer|min:1',
            'min_consultation_value' => 'nullable|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
        ]);

        $reward->update($validated);

        return redirect()->route('admin.rewards.index')
            ->with('success', 'Reward updated successfully');
    }

    /**
     * Remove the specified reward from storage.
     */
    public function destroy($id)
    {
        $reward = Reward::findOrFail($id);
        $reward->delete();

        return redirect()->route('admin.rewards.index')
            ->with('success', 'Reward deleted successfully');
    }

    /**
     * Toggle status of the specified reward.
     */
    public function toggleStatus($id)
    {
        $reward = Reward::findOrFail($id);

        $reward->status = $reward->status === Reward::STATUS_ACTIVE
            ? Reward::STATUS_CANCELLED
            : Reward::STATUS_ACTIVE;

        $reward->save();

        return back()->with('success', 'Reward status updated successfully');
    }
}
