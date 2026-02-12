<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $socialMedias = $user->doctorSocialMedia;
        return view('doctor.social.index', compact('socialMedias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required|string',
            'url' => 'required|url',
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();
        $user->doctorSocialMedia()->create([
            'platform' => $request->platform,
            'url' => $request->url,
        ]);

        return back()->with('success', 'Social media account added successfully.');
    }

    public function update(Request $request, $id)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $socialMedia = $user->doctorSocialMedia()->findOrFail($id);

        $request->validate([
            'platform' => 'required|string',
            'url' => 'required|url',
        ]);

        $socialMedia->update([
            'platform' => $request->platform,
            'url' => $request->url,
        ]);

        return back()->with('success', 'Social media account updated successfully.');
    }

    public function destroy($id)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $socialMedia = $user->doctorSocialMedia()->findOrFail($id);
        $socialMedia->delete();

        return back()->with('success', 'Social media account deleted successfully.');
    }
}
