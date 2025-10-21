<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $project=Projects::orderBy('id','DESC')->get();
        return view('backend.projects.index',compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.projects.create');
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
        'company'=>'string|required',
        'type'=>'string|nullable',
        'youtubeurl'=>'string|nullable',
        'discreption'=>'string|nullable',
        'photo'=>'string|required',
        'status'=>'nullable|in:active,inactive',
           ]);
           $data=$request->all();
           $slug =Str::slug($request->input('title'));
           $slug_count=Projects::where('slug',$slug)->count();
           if ($slug_count>0) {
            $slug =time().'-'.$slug;
           }
           $data['slug'] =$slug;
            //return $data;
            //return $request->all();
           $status=Projects::create($data);
           if ($status) {
            return redirect()->route('Projects.index')->with('success','Created project ');

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
        $project = Projects::find($id);
        if ($project) {
            # code...
            return view('backend.projects.edit',compact('project'));
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

        $project = Projects::find($id);
        if ($project) {

        }else{
            return back()->with('error', 'error with id ');
        }
         //return $request->all();
       $this->validate($request,[
        'title'=>'string|required',
        'company'=>'string|required',
        'type'=>'string|nullable',
        'youtubeurl'=>'string|nullable',
        'discreption'=>'string|nullable',
        'photo'=>'string|required',
        'status'=>'nullable|in:active,inactive',
       ]);
       $data=$request->all();
       $status=$project->fill($data)->save();
       if ($status) {
        return redirect()->route('project.index')->with('success','Updated project ');
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
        $project = Projects::find($id);
        if ($project) {
            $status=$project->delete();
            if ($status) {
                return redirect()->route('project.index')->with('success',' Record Deleted');
            }
        }else{
            return back()->with('error', 'error with data ');
        }
    }
}
