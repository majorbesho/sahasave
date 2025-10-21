<?php

namespace App\Http\Controllers;

use App\Models\Emp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;



class EmpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
        //
        $emp=Emp::orderBy('id','DESC')->get();
        return view('backend.emp.index',compact('emp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.emp.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmpRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'name'=>'string|required',
            'email'=>'email|required|unique:users,email',
            'photo'=>'string|required',
            'password'=>'min:4|required',
            'status'=>'nullable|in:active,inactive',
            'phone'=>'string|nullable',
            'photo'=>'string|nullable',
            'repcode'=>'string|nullable',
           ]);
           $data= $request->all();
           $data['password'] = Hash::make($request->password);
           //return $data;
           $status=Emp::create($data);
           if ($status) {
            return redirect()->route('emp.index')->with('success','Created emp ');

           }else{
            return back()->with('error','somsthig wrong emp');
           }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Emp  $emp
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emp  $emp
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //
        $emp = Emp::find($id);
        if ($emp) {

            return view('backend.emp.edit',compact('emp'));
        }else{
            return back()->with('error', 'error with id ');
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmpRequest  $request
     * @param  \App\Models\Emp  $emp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = emp::find($id);
        if ($user) {
            $this->validate($request,[
                'name'=>'string|required',
                'email'=>'email|required|unique:users,email',
                'photo'=>'string|required',
                'password'=>'min:4|required',
                'status'=>'nullable|in:active,inactive',
                'phone'=>'string|nullable',
                'photo'=>'string|nullable',
                'repcode'=>'string|nullable',
            ]);
               // return $request->all();
            $data=$request->all();

            $status=$user->fill($data)->save();
            if ($status) {
               // return $status;
            return redirect()->route('emp.index')->with('success','updated emp ');
        }
        else{
             return back()->with('error','somethig wrong emp');
            }
            }else{
            return back()->with('error', 'error with id ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Emp  $emp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = emp::find($id);
        if ($user) {
            $status=$user->delete();
            if ($status) {
                return redirect()->route('emp.index')->with('success',' Record Deleted');
            }else{
            return back()->with('error', 'error with data ');
        }

    }

    }
}
