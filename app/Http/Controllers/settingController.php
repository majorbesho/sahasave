<?php

namespace App\Http\Controllers;
use Validator;
use App\Models\setting;
use Illuminate\Http\Request;

class settingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $setting=setting::orderBy('id','DESC')->get();
        return view('backend.setting.index',compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.setting.create');
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
        // 'facebookUrl',
        
        $this->validate($request,[
            
        'facebookUrl'=>'required|string|max:200|min:1',
        'twiettr'=>'string|nullable',
        'linkedin'=>'string|nullable',
        'insta'=>'string|nullable',
        'youtube'=>'string|nullable',
        'google'=>'string|nullable',
        'WHATWEDO'=>'string|nullable',
        'OURMISSION'=>'string|nullable',
        'WHYCHOOSEUS'=>'string|nullable',
        'ProductsandServices'=>'string|nullable',
        'no1'=>'string|nullable',
        'text1'=>'string|nullable',
        'no2'=>'string|nullable',
        'text2'=>'string|nullable',
        'no3'=>'string|nullable',
        'text3'=>'string|nullable',
        'no4'=>'string|nullable',
        'text4'=>'string|nullable',
        'email'=>'string|nullable',
        'tele'=>'string|nullable',
            
           ]);
           $data=$request->all();
          
           // return $data;
            //return $request->all();
           $status=setting::create($data);
           if ($status) {
            return redirect()->route('setting.index')->with('success','Created setting ');
    
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
        $setting = setting::find($id);
        if ($setting) {
            # code...
            return view('backend.setting.edit',compact('setting'));
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
        $setting = setting::find($id);
        if ($setting) {

        }else{
            return back()->with('error', 'error with id ');
        }
         //return $request->all();
         $this->validate($request,[
            'facebookUrl'=>'string|required',
            'twiettr'=>'string|nullable',
            'linkedin'=>'string|nullable',
            'insta'=>'string|nullable',
            'youtube'=>'string|nullable',
            'google'=>'string|nullable',
            'WHATWEDO'=>'string|nullable',
            'OURMISSION'=>'string|nullable',
            'WHYCHOOSEUS'=>'string|nullable',
            'ProductsandServices'=>'string|nullable',
            'no1'=>'string|nullable',
            'text1'=>'string|nullable',
            'no2'=>'string|nullable',
            'text2'=>'string|nullable',
            'no3'=>'string|nullable',
            'text3'=>'string|nullable',
            'no4'=>'string|nullable',
            'text4'=>'string|nullable',
            'email'=>'string|nullable',
            'tele'=>'string|nullable',
                
       ]);
       $data=$request->all();
       $status=$setting->fill($data)->save();
       if ($status) {
        return redirect()->route('setting.index')->with('success','Updated setting ');
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
        $setting = setting::find($id);
        return $setting;
        if ($setting) {
            $status=$setting->delete();
            if ($status) {
                return redirect()->route('setting.index')->with('success',' Record Deleted');
            }
        }else{
            return back()->with('error', 'error with data ');
        }
    }
}
