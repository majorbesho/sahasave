<?php

namespace App\Http\Controllers;
use App\Models\focus;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FocusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $focus=focus::orderBy('id','DESC')->get();
        return view('backend.focus.index',compact('focus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.focus.create');
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
        'title'=>'string|required',
        //'slug'=>'string|required',
        'discreption'=>'string|nullable',
        'photo'=>'string|required',
        'status'=>'nullable|in:active,inactive',
        'mainWord'=>'string|required',

       ]);
       $data=$request->all();
       $slug =Str::slug($request->input('title'));
       $slug_count=focus::where('slug',$slug)->count();
       if ($slug_count>0) {
        $slug =time().'-'.$slug;
       }
       $data['slug'] =$slug;
        //return $data;
        //return $request->all();
       $status=focus::create($data);
       if ($status) {
        return redirect()->route('focus.index')->with('success','Created focus ');

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
          $focus = focus::find($id);
        if ($focus) {
            # code...
            return view('backend.focus.edit',compact('focus'));
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

        $focus = focus::find($id);
        if ($focus) {

        }else{
            return back()->with('error', 'error with id ');
        }
         //return $request->all();
       $this->validate($request,[
        'title'=>'string|required',
        //'slug'=>'string|required',
        'discreption'=>'string|nullable',
        'photo'=>'string|required',
        'status'=>'nullable|in:active,inactive',

       ]);
       $data=$request->all();
       $status=$focus->fill($data)->save();
       if ($status) {
        return redirect()->route('focus.index')->with('success','Updated focus ');
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

        $focus = focus::find($id);
        if ($focus) {
            $status=$focus->delete();
            if ($status) {
                return redirect()->route('focus.index')->with('success',' Record Deleted');
            }
        }else{
            return back()->with('error', 'error with data ');
        }
    }
}
