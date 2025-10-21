<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckAttachmentPermission;
use App\Models\attachments;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AttachmentsController extends Controller
{





    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(CheckAttachmentPermission::class);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB كحد أقصى
            'purpose' => 'required|string|max:255',
        ]);

        $user = $request->user();
        $file = $request->file('file');

        $path = $file->store('attachments/' . Str::snake(class_basename($user)) . '/' . $user->id, 'private');

        $attachment = $user->attachments()->create([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
            'purpose' => $request->purpose,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'File uploaded successfully, waiting for admin approval',
            'attachment' => $attachment
        ], 201);
    }

    public function index(Request $request)
    {
        $user = $request->user();
        return response()->json($user->attachments);
    }

    public function show(Request $request, $id)
    {
        $attachment = attachments::findOrFail($id);

        // التحقق من أن الملف يخص المستخدم
        if (
            $attachment->attachable_id != $request->user()->id ||
            get_class($request->user()) != $attachment->attachable_type
        ) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // التحقق من أن الملف معتمد
        if ($attachment->status != 'approved') {
            return response()->json(['message' => 'File not approved yet'], 403);
        }

        $path = Storage::disk('private')->path($attachment->file_path);

        return response()->file($path);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\attachments  $attachments
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\attachments  $attachments
     * @return \Illuminate\Http\Response
     */
    public function edit(attachments $attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\attachments  $attachments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, attachments $attachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\attachments  $attachments
     * @return \Illuminate\Http\Response
     */
    public function destroy(attachments $attachments)
    {
        //
    }
}
