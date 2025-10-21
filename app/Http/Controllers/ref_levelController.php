<?php

namespace App\Http\Controllers;

use App\Models\ref_levels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ref_levelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $refLevel=ref_levels::orderBy('id','DESC')->get();
        return view('backend.ref_level.index',compact('refLevel'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.ref_level.create');
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
        $this->validate($request,[

            'photo'=>'string|required',
            'status'=>'nullable|in:active,inactive',
            'name'=>'string|required',
            'title'=>'string|required',
        ]);
           $data=$request->all();
           $slug =Str::slug($request->input('title'));
           $slug_count=ref_levels::where('slug',$slug)->count();
           if ($slug_count>0) {
            $slug =time().'-'.$slug;
           }
           $data['slug'] =$slug;
            //return $data;
            //return $request->all();
           $status=ref_levels::create($data);
           if ($status) {
            return redirect()->route('ref_level.index')->with('success','Created ref_level ');

           }else{
            return back()->with('error','somsthig wrong ');
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
        $reflevel = ref_levels::find($id);
        if ($reflevel) {

            return view('backend.ref_level.edit',compact('reflevel'));
        }else{
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
        $reflevel = ref_levels::find($id);
        if ($reflevel) {

        }else{
            return back()->with('error', 'error with id ');
        }
         //return $request->all();
       $this->validate($request,[

        'photo'=>'string|required',
        'status'=>'nullable|in:active,inactive',
        'name'=>'string|required',
        'title'=>'string|required',


       ]);
       $data=$request->all();
       $status=$reflevel->fill($data)->save();
       if ($status) {
        return redirect()->route('ref_level.index')->with('success','Updated ref_level ');
       }else{
        return back()->with('error','somsthig wrong ');
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
        $reflevel = ref_levels::find($id);
        if ($reflevel) {
            $status=$reflevel->delete();
            if ($status) {
                return redirect()->route('ref_levels.index')->with('success',' Record Deleted');
            }
        }else{
            return back()->with('error', 'error with data ');
        }

    }
}
