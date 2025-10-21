<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class taskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tasks=task::orderBy('id','DESC')->get();
        return view('backend.task.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.task.create');
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
            'status'=>'nullable|in:active,inactive',
            'name'=>'string|required',
            'title'=>'string|required',
            'instrac'=>'string|nullable',
            'user_id'=>'string|nullable',
            'reward_points'=>'string|nullable',
            ]);
               $data=$request->all();
               $slug =Str::slug($request->input('title'));
               $slug_count=task::where('slug',$slug)->count();
               if ($slug_count>0) {
                $slug =time().'-'.$slug;
               }
               $data['slug'] =$slug;

               $status=task::create($data);
               if ($status) {
                return redirect()->route('task.index')->with('success','Created task ');

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
        $task = task::find($id);
        if ($task) {
            return view('backend.task.edit',compact('task'));
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

        $tasks = task::find($id);
        if ($tasks) {

        }else{
            return back()->with('error', 'error with id ');
        }
         //return $request->all();
       $this->validate($request,[

        'status'=>'nullable|in:active,inactive',
        'name'=>'string|required',
        'title'=>'string|required',
        'instrac'=>'string|nullable',
        'user_id'=>'string|nullable',
        'reward_points'=>'string|nullable',


       ]);
       $data=$request->all();
       $status=$tasks->fill($data)->save();
       if ($status) {
        return redirect()->route('task.index')->with('success','Updated ref_level ');
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

        $tasks = task::find($id);
        if ($tasks) {
            $status=$tasks->delete();
            if ($status) {
                return redirect()->route('task.index')->with('success',' Record Deleted');
            }
        }else{
            return back()->with('error', 'error with data ');
        }

    }
}
