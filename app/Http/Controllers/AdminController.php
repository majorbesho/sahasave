<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\attachments;
use App\Models\order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function admin()
    {
        return view('backend.index');
    }



    public function pending()
    {
        return view('admin.attachments.pending');
    }

    public function approve(Request $request, $id)
    {
        $attachment = Attachment::findOrFail($id);

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

        $attachment = Attachment::findOrFail($id);

        $attachment->update([
            'status' => 'rejected',
            'admin_id' => $request->user()->id,
            'rejection_reason' => $request->reason,
        ]);

        return back()->with('success', 'File rejected successfully');
    }
}
