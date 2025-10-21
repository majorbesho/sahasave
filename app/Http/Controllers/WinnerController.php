<?php

namespace App\Http\Controllers;

use App\Models\winner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class WinnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $winners=winner::orderBy('id','DESC')->get();
        return view('backend.winner.index',compact('winners'));
    }
    public function winnerStatus(Request $request)
    {
        //dd($request->all());
        if ($request->mode==true) {
           DB::table('winners')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('winners')->where('id',$request->id)->update(['status'=>'inactive']);

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
        return view('backend.winner.create');

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
            'name'=>'string|required',
            'fullName'=>'string|required',
            'email'=>'string|required',
            'address'=>'string|required',

            'nationality'=>'string|nullable',
            'photo'=>'string|required',
            'phone'=>'string|required',
            'status'=>'nullable|in:active,inactive',
            'dateOfbarth'=>'string|nullable',
            'name'=>'string|nullable',
           ]);
           $data=$request->all();
           $slug =Str::slug($request->input('title'));
           $slug_count=winner::where('slug',$slug)->count();
           if ($slug_count>0) {
            $slug =time().'-'.$slug;
           }
           $data['slug'] =$slug;
            //return $data;
            //return $request->all();
           $status=winner::create($data);
           if ($status) {
            return redirect()->route('winner.index')->with('success','Created winner ');

           }else{
            return back()->with('error','somsthig wrong ');
           }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\winner  $winner
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\winner  $winner
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //
        $winner = winner::find($id);
        if ($winner) {
            # code...
            return view('backend.winner.edit',compact('winner'));
        }else{
            return back()->with('error', 'error with id ');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\winner  $winner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //

        $winner = winner::find($id);
        if ($winner) {

        }else{
            return back()->with('error', 'error with id ');
        }
         //return $request->all();
       $this->validate($request,[
        'name'=>'string|required',
        'fullName'=>'string|required',
        'email'=>'string|required',
        'address'=>'string|required',

        'nationality'=>'string|nullable',
        'photo'=>'string|required',
        'phone'=>'string|required',
        'status'=>'nullable|in:active,inactive',
        'dateOfbarth'=>'string|nullable',
        'name'=>'string|nullable',
       ]);
       $data=$request->all();
       $status=$winner->fill($data)->save();
       if ($status) {
        return redirect()->route('winner.index')->with('success','Updated winner ');
       }else{
        return back()->with('error','somsthig wrong ');
       }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\winner  $winner
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //

        $winner = winner::find($id);
        if ($winner) {
            $status=$winner->delete();
            if ($status) {
                return redirect()->route('winner.index')->with('success',' Record Deleted');
            }
        }else{
            return back()->with('error', 'error with data ');
        }
    }
}

