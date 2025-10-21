<?php

namespace App\Http\Controllers;

use App\Models\faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $faq=faq::orderBy('id','DESC')->get();
        return view('backend.faq.index',compact('faq'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('backend.faq.create');
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
            'discreption'=>'string|nullable',
            'photo'=>'string|nullable',
            'qu'=>'string|nullable',
            'answer'=>'string|nullable',
            'status'=>'nullable|in:active,inactive',
           ]);
           $data=$request->all();
           $slug =Str::slug($request->input('title'));
           $slug_count=faq::where('slug',$slug)->count();
           if ($slug_count>0) {
            $slug =time().'-'.$slug;
           }
           $data['slug'] =$slug;
            //return $data;
            //return $request->all();
           $status=faq::create($data);
           if ($status) {
            return redirect()->route('faq.index')->with('success','Created faq ');
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


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $faq = faq::find($id);
        if ($faq) {

            return view('backend.faq.edit',compact('faq'));
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
        $faq = faq::find($id);
        if ($faq) {

        }else{
            return back()->with('error', 'error with id ');
        }
         //return $request->all();
         $this->validate($request,[
            'title'=>'string|required',
            'discreption'=>'string|nullable',
            'photo'=>'string|nullable',
            'qu'=>'string|nullable',
            'answer'=>'string|nullable',
            'status'=>'nullable|in:active,inactive',
           ]);
       $data=$request->all();
       $status=$faq->fill($data)->save();
       if ($status) {
        return redirect()->route('faq.index')->with('success','Updated faq ');
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

        $faq = faq::find($id);
        if ($faq) {
            $status=$faq->delete();
            if ($status) {
                return redirect()->route('faq.index')->with('success',' Record Deleted');
            }
        }else{
            return back()->with('error', 'error with data ');
        }
    }
}
