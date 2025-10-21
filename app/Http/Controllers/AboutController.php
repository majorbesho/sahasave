<?php

namespace App\Http\Controllers;

use App\Models\about;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $about=about::orderBy('id','DESC')->get();
        return view('backend.about.index',compact('about'));


    }

    public function aboutStatus(Request $request)
    {
        //dd($request->all());
        if ($request->mode==true) {
           DB::table('abouts')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('abouts')->where('id',$request->id)->update(['status'=>'inactive']);

        }
        return response()->json(['msg'=>'successfuly ','status'=>true]);
        //

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreaboutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //return $request->all();
         $this->validate($request,[
            'title'=>'string|required',
            //'slug'=>'string|required',
            'discreption'=>'string|nullable',
            'sdiscreption'=>'string|nullable',
            'photo'=>'string|required',
            'status'=>'nullable|in:active,inactive',
            'youtubeUrl'=>'string|nullable',
            'mainImg'=>'string|nullable',
            'testim_caption'=>'string|nullable',
            'team_caption'=>'string|nullable',
            'mainImg'=>'string|nullable',
            'no1'=>'string|nullable',
            'text1'=>'string|nullable',
            'no2'=>'string|nullable',
            'text2'=>'string|nullable',
            'no3'=>'string|nullable',
            'text3'=>'string|nullable',
            'no4'=>'string|nullable',
            'text4'=>'string|nullable',

            'address'=>'string|nullable',
            'city'=>'string|nullable',

           ]);
           $data=$request->all();
           $slug =Str::slug($request->input('title'));
           $slug_count=about::where('slug',$slug)->count();
           if ($slug_count>0) {
            $slug =time().'-'.$slug;
           }
           $data['slug'] =$slug;
            //return $data;
            //return $request->all();
           $status=about::create($data);
           if ($status) {
            return redirect()->route('about.index')->with('success','Created about ');

           }else{
            return back()->with('error','somsthig wrong ');
           }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\about  $about
     * @return \Illuminate\Http\Response
     */
    public function show(about $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\about  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        //
        $about = about::find($id);
        if ($about) {
            # code...
            return view('backend.about.edit',compact('about'));
        }else{
            return back()->with('error', 'error with id ');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateaboutRequest  $request
     * @param  \App\Models\about  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //



        $about = about::find($id);
        if ($about) {

        }else{
            return back()->with('error', 'error with id ');
        }
         //return $request->all();
       $this->validate($request,[
        'title'=>'string|required',
        //'slug'=>'string|required',
        'discreption'=>'string|nullable',
        'sdiscreption'=>'string|nullable',
        'photo'=>'string|required',
        'status'=>'nullable|in:active,inactive',
        'youtubeUrl'=>'string|nullable',
        'mainImg'=>'string|nullable',
        'testim_caption'=>'string|nullable',
        'team_caption'=>'string|nullable',
        'mainImg'=>'string|nullable',
        'no1'=>'string|nullable',
        'text1'=>'string|nullable',
        'no2'=>'string|nullable',
        'text2'=>'string|nullable',
        'no3'=>'string|nullable',
        'text3'=>'string|nullable',
        'no4'=>'string|nullable',
        'text4'=>'string|nullable',
        'address'=>'string|nullable',
        'city'=>'string|nullable',
       ]);
       $data=$request->all();
       $status=$about->fill($data)->save();
       if ($status) {
        return redirect()->route('about.index')->with('success','Updated about ');
       }else{
        return back()->with('error','somsthig wrong ');
       }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\about  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //

        $about = about::find($id);
        if ($about) {
            $status=$about->delete();
            if ($status) {
                return redirect()->route('about.index')->with('success',' Record Deleted');
            }
        }else{
            return back()->with('error', 'error with data ');
        }

    }
}
