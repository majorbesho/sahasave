<?php

namespace App\Http\Controllers;

use App\Models\user_task;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class user_taskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_task = user_task::orderBy('id', 'DESC')->get();
        return view('backend.user_task.index', compact('user_task'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //user_task
        return view('backend.user_task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $this->validate($request, [

            'name' => 'string|required',
            'title' => 'string|required',
            'user_id' => 'string|nullable',
            'task_id' => 'string|nullable',
            'reward_points' => 'string|nullable',
            'proof' => 'string|nullable',
            'status' => 'nullable|in:active,inactive',
        ]);
        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = user_task::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '-' . $slug;
        }
        $data['slug'] = $slug;
        //return $data;
        //return $request->all();
        $status = user_task::create($data);
        if ($status) {
            return redirect()->route('user_task.index')->with('success', 'Created ref_category ');
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
        $user_task = user_task::find($id);
        if ($user_task) {
            return view('backend.user_task.edit', compact('user_task'));
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
        $user_task = user_task::find($id);
        if ($user_task) {
        } else {
            return back()->with('error', 'error with id ');
        }
        //return $request->all();
        $this->validate($request, [
            'status' => 'nullable|in:active,inactive',
            'name' => 'string|required',
            'title' => 'string|required',
            'user_id' => 'string|nullable',
            'task_id' => 'string|nullable',
            'reward_points' => 'string|nullable',


        ]);
        $data = $request->all();
        $status = $user_task->fill($data)->save();
        if ($status) {
            return redirect()->route('user_task.index')->with('success', 'Updated user_task ');
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

        $user_task = user_task::find($id);
        if ($user_task) {
            $status = $user_task->delete();
            if ($status) {
                return redirect()->route('user_task.index')->with('success', ' Record Deleted');
            }
        } else {
            return back()->with('error', 'error with data ');
        }
    }
}
