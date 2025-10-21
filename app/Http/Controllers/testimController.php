<?php

namespace App\Http\Controllers;

use App\Models\testim;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class testimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $testim=testim::orderBy('id','DESC')->get();
        return view('backend.testim.index',compact('testim'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.testim.create');


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
        $this->validate($request,[
            'title'=>'string|required',
            'name'=>'string|required',
            'company'=>'string|required',
            'discreption'=>'string|nullable',
            'photo'=>'string|required',
            'status'=>'nullable|in:active,inactive',
           ]);
           //return $request->all();
           $data=$request->all();
           $slug =Str::slug($request->input('title'));
           $slug_count=testim::where('slug',$slug)->count();
           if ($slug_count>0) {
            $slug =time().'-'.$slug;
           }
           $data['slug'] =$slug;
            //return $data;
            //return $request->all();
           $status=testim::create($data);
           if ($status) {
            return redirect()->route('testim.index')->with('success','Created testim ');

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
        $testim = testim::find($id);
        if ($testim) {
            # code...
            return view('backend.testim.edit',compact('testim'));
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

        $testim = testim::find($id);
        if ($testim) {

        }else{
            return back()->with('error', 'error with id ');
        }
         //return $request->all();
         $this->validate($request,[
            'title'=>'string|required',
            'name'=>'string|required',
            'company'=>'string|required',
            'discreption'=>'string|nullable',
            'photo'=>'string|required',
            'status'=>'nullable|in:active,inactive',
           ]);
       $data=$request->all();
       $status=$testim->fill($data)->save();
       if ($status) {
        return redirect()->route('testim.index')->with('success','Updated testim ');
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

        $testim = testim::find($id);
        if ($testim) {
            $status=$testim->delete();
            if ($status) {
                return redirect()->route('testim.index')->with('success',' Record Deleted');
            }
        }else{
            return back()->with('error', 'error with data ');
        }
    }
}
