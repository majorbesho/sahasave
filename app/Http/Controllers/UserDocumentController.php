<?php

namespace App\Http\Controllers;

use App\Models\UserDocument;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;



class UserDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    //  'user_id',
    //     // 'suppliers_id',
    //     'filename',
    //     'path',
    //     'mime_type',
    //     'size',

    public function index()
    {
        //
        $documents = UserDocument::where('user_id', Auth::id())->get();
        return view('documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('documents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'documents' => 'required|array', // Validate that 'documents' is an array
            'documents.*' => 'file|mimes:pdf,doc,docx,xls,xlsx,txt,jpg,jpeg,png|max:2048', // Validate each file in the array
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('documents', $filename, 'public');

                UserDocument::create([
                    'user_id' => Auth::id(),
                    'filename' => $filename,
                    'path' => $path,
                    'mime_type' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                ]);
            }
        }

        return redirect()->route('documents.index')->with('success', 'Documents uploaded successfully.');
    }





    // public function download(UserDocument $document)
    // {
    //     if ($document->user_id !== Auth::id()) {
    //         abort(403, 'Unauthorized.');
    //     }

    //     $path = storage_path('app/public/' . $document->path); // Construct the full path

    //     if (!File::exists($path)) {
    //         abort(404, 'File not found.');
    //     }

    //     return Response::download($path, $document->filename);
    // }


    /**s
     * Display the specified resource.
     *
     * @param  \App\Models\UserDocument  $userDocument
     * @return \Illuminate\Http\Response
     */
    public function show(UserDocument $userDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserDocument  $userDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(UserDocument $userDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserDocument  $userDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserDocument $userDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserDocument  $userDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDocument $userDocument)
    {
        //
        if ($userDocument->user_id !== Auth::id()) {
            abort(403, 'Unauthorized.');
        }

        Storage::disk('public')->delete($userDocument->path);
        $userDocument->delete();

        return redirect()->route('documents.index')->with('success', 'Document deleted successfully.');
    }
}
