<?php

namespace App\Http\Controllers;

use App\Models\art;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $arts = art::orderBy('id', 'DESC')->get();
        return view('backend.art.index', compact('arts'));
    }

    public function about()
    {
        $arts = art::where('status', 'active')->latest()->take(4)->get();
        return $arts;
    }

    //art_status

    // public function (Request $request)
    // {
    //     if ($request) {

    //     }
    //     $arts=art::orderBy('id','DESC')->get();
    //     return view('backend.art.index',compact('arts'));
    // }

    public function artstatus(Request $request)
    {
        //dd($request->all());
        if ($request->mode == true) {
            DB::table('art')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('art')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'successfuly ', 'status' => true]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.art.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //return $request->all();
        $this->validate($request, [
            'title' => 'string|required',
            //'slug'=>'string|required',
            'discreption' => 'string|nullable',
            'photo' => 'string|required',
            'status' => 'nullable|in:active,inactive',
        ]);
        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = art::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '-' . $slug;
        }
        $data['slug'] = $slug;
        //return $data;
        //return $request->all();
        $status = art::create($data);
        if ($status) {
            return redirect()->route('art.index')->with('success', 'Created art ');
        } else {
            return back()->with('error', 'somsthig wrong ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $art = art::find($id);
        if ($art) {
            # code...
            return view('backend.art.edit', compact('art'));
        } else {
            return back()->with('error', 'error with id ');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $art = art::find($id);
        if ($art) {
        } else {
            return back()->with('error', 'error with id ');
        }
        //return $request->all();
        $this->validate($request, [
            'title' => 'string|required',
            //'slug'=>'string|required',
            'discreption' => 'string|nullable',
            'photo' => 'string|required',
            'status' => 'nullable|in:active,inactive',

        ]);
        $data = $request->all();
        $status = $art->fill($data)->save();
        if ($status) {
            return redirect()->route('art.index')->with('success', 'Updated art ');
        } else {
            return back()->with('error', 'somsthig wrong ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $art = art::find($id);
        if ($art) {
            $status = $art->delete();
            if ($status) {
                return redirect()->route('art.index')->with('success', ' Record Deleted');
            }
        } else {
            return back()->with('error', 'error with data ');
        }
    }
}
