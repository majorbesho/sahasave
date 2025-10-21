<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $user = User::orderBy('id', 'DESC')->get();
        return view('backend.users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'string|required',
            'email' => 'email|required|unique:users,email',
            'photo' => 'string|required',
            'password' => 'min:4|required',
            //'role'=>'nullable|in:admin,customer',
            'status' => 'nullable|in:active,inactive',
            'phone' => 'string|nullable',
            'address' => 'string|nullable',
            'nationality' => 'string|nullable',
            'dateOfbarth' => 'string|nullable',
        ]);
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        //return $data;
        $status = User::create($data);
        if ($status) {
            return redirect()->route('users.index')->with('success', 'Created user ');
        } else {
            return back()->with('error', 'somsthig wrong user');
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

        $user = User::find($id);
        if ($user) {

            return view('backend.users.edit', compact('user'));
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
        $user = User::find($id);
        if ($user) {
            $this->validate($request, [
                'name' => 'string|required',
                'email' => 'email|required|unique:users,email',
                'photo' => 'string|required',
                'password' => 'min:4|required',
                //'role'=>'nullable|in:admin,customer',
                'status' => 'nullable|in:active,inactive',
                'phone' => 'string|nullable',
                'address' => 'string|nullable',
                'nationality' => 'string|nullable',
                'dateOfbarth' => 'string|nullable',
            ]);
            // return $request->all();
            $data = $request->all();

            $status = $user->fill($data)->save();
            if ($status) {
                // return $status;
                return redirect()->route('users.index')->with('success', 'updated users ');
            } else {
                return back()->with('error', 'somethig wrong users');
            }
        } else {
            return back()->with('error', 'error with id ');
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
        $user = User::find($id);
        if ($user) {
            $status = $user->delete();
            if ($status) {
                return redirect()->route('users.index')->with('success', ' Record Deleted');
            } else {
                return back()->with('error', 'error with data ');
            }
        }
    }
}
