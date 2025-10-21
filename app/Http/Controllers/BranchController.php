<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $branch=Branch::orderBy('id','DESC')->get();
        return view('backend.branch.index',compact('branch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('backend.branch.create');
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
         //
         $this->validate($request,[
            'title'=>'string|required',
            'discreption'=>'string|nullable',
            'photo'=>'string|required',
            // 'photo2'=>'string|required',
            // 'photo3'=>'string|nullable',
            'googleL'=>'string|nullable',
            'googleE'=>'string|nullable',
            'tele'=>'string|nullable',
            'email'=>'string|nullable',
            'status'=>'nullable|in:active,inactive',
           ]);
           $data=$request->all();
           $slug =Str::slug($request->input('title'));
           $slug_count=Branch::where('slug',$slug)->count();
           if ($slug_count>0) {
            $slug =time().'-'.$slug;
           }
           $data['slug'] =$slug;
            //return $data;
            //return $request->all();
           $status=Branch::create($data);
           if ($status) {
            return redirect()->route('branch.index')->with('success','Created Branch ');

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
        $branch = branch::find($id);
        if ($branch) {

            return view('backend.branch.edit',compact('branch'));
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
        $branch = Branch::find($id);
        if ($branch) {

        }else{
            return back()->with('error', 'error with id ');
        }
         //return $request->all();
         $this->validate($request,[
            'title'=>'string|required',
            'discreption'=>'string|nullable',
            'photo'=>'string|required',
            // 'photo2'=>'string|required',
            // 'photo3'=>'string|nullable',
            'googleL'=>'string|nullable',
            'googleE'=>'string|nullable',
            'tele'=>'string|nullable',
            'email'=>'string|nullable',
            'status'=>'nullable|in:active,inactive',
           ]);
       $data=$request->all();
       $status=$branch->fill($data)->save();
       if ($status) {
        return redirect()->route('branch.index')->with('success','Updated branch ');
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
        $branch = branch::find($id);
        if ($branch) {
            $status=$branch->delete();
            if ($status) {
                return redirect()->route('branch.index')->with('success',' Record Deleted');
            }
        }else{
            return back()->with('error', 'error with data ');
        }

    }
}
