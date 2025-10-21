<?php

namespace App\Http\Controllers;

use App\Models\team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class teamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $team=team::orderBy('id','DESC')->get();
        return view('backend.team.index',compact('team'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.team.create');

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
        'name'=>'string|required',
        // 'jobs'=>'string|required',
        'addtext'=>'string|required',
        'facebook'=>'string|required',
        'twitter'=>'string|nullable',
        'google'=>'string|nullable',
        'discreption'=>'string|nullable',
        'photo'=>'string|required',
        'status'=>'nullable|in:active,inactive',
       ]);
       //return $request->all();
       $data=$request->all();
       $slug =Str::slug($request->input('title'));
       $slug_count=team::where('slug',$slug)->count();
       if ($slug_count>0) {
        $slug =time().'-'.$slug;
       }
       $data['slug'] =$slug;
        //return $data;
        //return $request->all();
       $status=team::create($data);
       if ($status) {
        return redirect()->route('team.index')->with('success','Created team ');

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
        $team = team::find($id);
        if ($team) {
            # code...
            return view('backend.team.edit',compact('team'));
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


        $team = team::find($id);
        if ($team) {

        }else{
            return back()->with('error', 'error with id ');
        }
         //return $request->all();
         $this->validate($request,[
            'title'=>'string|required',
            'name'=>'string|required',
            // 'jobs'=>'string|required',
            'addtext'=>'string|required',
            'facebook'=>'string|required',
            'twitter'=>'string|nullable',
            'google'=>'string|nullable',
            'discreption'=>'string|nullable',
            'photo'=>'string|required',
            'status'=>'nullable|in:active,inactive',
           ]);
       $data=$request->all();
       $status=$team->fill($data)->save();
       if ($status) {
        return redirect()->route('team.index')->with('success','Updated team ');
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
        $team = team::find($id);
        if ($team) {
            $status=$team->delete();
            if ($status) {
                return redirect()->route('team.index')->with('success',' Record Deleted');
            }
        }else{
            return back()->with('error', 'error with data ');
        }

    }
}
