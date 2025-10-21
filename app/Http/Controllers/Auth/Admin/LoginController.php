<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;


class LoginController extends Controller
{
    //
    // public function credentials(Request $request){
    //     return ['email'=>$request->email,'password'=>$request->password
    //     ,'status'=>'active'];
    // }
    /**
     *
     *
     *showLoginForm
     */
    public function showLoginForm()
    {

        return view('backend.auth.login');
    }

    /**
     *
     * loginForm
     */
    public function loginForm(Request $request)
    {
        if (Auth::guard('admin')
            ->attempt(['email' => $request->email, 'password' => $request->password])
        ) {
            return redirect()->route('admin')->with('Success', 'You Are Login');
        }
        return back()->withInput($request->only('email'));
    }





    // public function showLoginFormSup(){
    //     $categorys = Category::where(['status' => 'active'])->with('gproducts')->orderBy('id', 'DESC')->get();

    //     return view('backend.auth.login',compact('categorys'));
    //     }

    /**
     *
     * loginForm
     */
    // public function loginFormSup(Request $request) {
    //     if (Auth::guard('admin')
    //     ->attempt(['email'=>$request->email,'password'=>$request->password])) {
    //       return redirect()->route('admin')->with('Success','You Are Login');
    //     }
    //         return back()->withInput($request->only('email'));

    // }



}
