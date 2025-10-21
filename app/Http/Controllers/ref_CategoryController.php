<?php

namespace App\Http\Controllers;

use App\Models\ref_gategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ref_CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $refgategory=ref_gategory::orderBy('id','DESC')->get();
        return view('backend.ref_category.index',compact('refgategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.ref_category.create');
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
        'photo'=>'string|nullable',
        'status'=>'nullable|in:active,inactive',
        'name'=>'string|required',
        'title'=>'string|required',
        'description'=>'string|nullable',
        'congratulatory_message'=>'string|nullable',
        'taget_no_ref'=>'string|nullable',
        'user_id'=>'string|nullable',
        'ref_count'=>'string|nullable',
        'ref_viset'=>'string|nullable',
        'ref_buy'=>'string|nullable',
        ]);
           $data=$request->all();
           $slug =Str::slug($request->input('title'));
           $slug_count=ref_gategory::where('slug',$slug)->count();
           if ($slug_count>0) {
            $slug =time().'-'.$slug;
           }
           $data['slug'] =$slug;
            //return $data;
            //return $request->all();
           $status=ref_gategory::create($data);
           if ($status) {
            return redirect()->route('ref_category.index')->with('success','Created ref_category ');

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
        $refgategory = ref_gategory::find($id);
        if ($refgategory) {

            return view('backend.ref_category.edit',compact('refgategory'));
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
        $refcategory = ref_gategory::find($id);
        if ($refcategory) {

        }else{
            return back()->with('error', 'error with id ');
        }
         //return $request->all();
        $this->validate($request,[
            'photo'=>'string|nullable',
            'status'=>'nullable|in:active,inactive',
            'name'=>'string|required',
            'title'=>'string|required',
            'description'=>'string|nullable',
            'congratulatory_message'=>'string|nullable',
            'taget_no_ref'=>'string|nullable',
            'user_id'=>'string|nullable',
            'ref_count'=>'string|nullable',
            'ref_viset'=>'string|nullable',
            'ref_buy'=>'string|nullable',

       ]);
       $data=$request->all();
       $status=$refcategory->fill($data)->save();
       if ($status) {
        return redirect()->route('ref_category.index')->with('success','Updated ref_category ');
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

        $refcategory = ref_gategory::find($id);
        if ($refcategory) {
            $status=$refcategory->delete();
            if ($status) {
                return redirect()->route('ref_category.index')->with('success',' Record Deleted');
            }
        }else{
            return back()->with('error', 'error with data ');
        }
    }
}
