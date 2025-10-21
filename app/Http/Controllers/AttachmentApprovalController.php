<?php

namespace App\Http\Controllers;

use App\Models\attachments;
use Illuminate\Http\Request;

class AttachmentApprovalController extends Controller
{
    public function pending()
    {
        $attachments = attachments::where('status', 'pending')->with('attachable')->get();
        return view('admin.attachments.pending', compact('attachments'));
    }

    public function approve(Request $request, $id)
    {
        $attachment = attachments::findOrFail($id);

        $attachment->update([
            'status' => 'approved',
            'admin_id' => $request->user()->id,
            'rejection_reason' => null,
        ]);

        return back()->with('success', 'File approved successfully');
    }

    public function reject(Request $request, $id)
    {
        $request->validate(['reason' => 'required|string|max:255']);

        $attachment = attachments::findOrFail($id);

        $attachment->update([
            'status' => 'rejected',
            'admin_id' => $request->user()->id,
            'rejection_reason' => $request->reason,
        ]);

        return back()->with('success', 'File rejected successfully');
    }
}
