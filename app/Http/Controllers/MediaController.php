<?php

namespace App\Http\Controllers;

use App\Models\media;
use App\Http\Requests\StoremediaRequest;
use App\Http\Requests\UpdatemediaRequest;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $media=media::orderBy('id','DESC')->get();
        return view('backend.media.index',compact('media'));
    }
    public function mediaStatus(Request $request)
    {
        //dd($request->all());
        if ($request->mode==true) {
           DB::table('media')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('media')->where('id',$request->id)->update(['status'=>'inactive']);
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
        return view('backend.media.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoremediaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'title'=>'string|required',
            'discreption'=>'string|nullable',
            'sdiscreption'=>'string|nullable',
            'photo'=>'string|required',
            'status'=>'nullable|in:active,inactive',
            'youtubeUrl'=>'string|nullable',
            'faceUrl'=>'string|nullable',
            'instabeUrl'=>'string|nullable',
           ]);
           $data=$request->all();
           $slug =Str::slug($request->input('title'));
           $slug_count=media::where('slug',$slug)->count();
           if ($slug_count>0) {
            $slug =time().'-'.$slug;
           }
           $data['slug'] =$slug;
            //return $data;
            //return $request->all();
           $status=media::create($data);
           if ($status) {
            return redirect()->route('media.index')->with('success','Created media ');
           }else{
            return back()->with('error','somsthig wrong ');
           }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(media $media)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit( Request $request,$id)
    {
        $media = media::find($id);
        if ($media) {
            return view('backend.media.edit',compact('media'));
        }else{
            return back()->with('error', 'error with id ');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatemediaRequest  $request
     * @param  \App\Models\media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $media = media::find($id);
        if ($media) {

        }else{
            return back()->with('error', 'error with id ');
        }
       $this->validate($request,[
        'title'=>'string|required',
        'title'=>'string|required',
        'discreption'=>'string|nullable',
        'sdiscreption'=>'string|nullable',
        'photo'=>'string|required',
        'status'=>'nullable|in:active,inactive',
        'youtubeUrl'=>'string|nullable',
        'faceUrl'=>'string|nullable',
        'instabeUrl'=>'string|nullable',
       ]);
       $data=$request->all();
       $status=$media->fill($data)->save();
       if ($status) {
        return redirect()->route('media.index')->with('success','Updated media ');
       }else{
        return back()->with('error','somsthig wrong ');
       }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $media = media::find($id);
        if ($media) {
            $status=$media->delete();
            if ($status) {
                return redirect()->route('media.index')->with('success',' Record Deleted');
            }
        }else{
            return back()->with('error', 'error with data ');
        }
    }
}
