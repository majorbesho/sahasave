<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\related_gproduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class related_gproductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 'main_related_id',
        // 'product_id',
        // 'qty',
        // 'discreption',
        // 'status',

        $rProducts=related_gproduct::orderBy('id','DESC')->get();
        return view('backend.rproduct.index',compact('rProducts'));
    }
    public function bannerStatus(Request $request)
    {
        //dd($request->all());
        if ($request->mode==true) {
           DB::table('related_gproduct')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('related_gproduct')->where('id',$request->id)->update(['status'=>'inactive']);
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
         return view('backend.rproduct.create');
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
        $this->validate($request,[


        'main_related_id'=>'integer|nullable',
        'product_id'=>'integer|nullable',
        'qty'=>'integer|nullable',
        'status'=>'nullable|in:active,inactive',
        'discreption'=>'string|nullable',

       ]);
       $data=$request->all();

        //return $data;
        //return $request->all();
       $status=related_gproduct::create($data);
       if ($status) {
        return redirect()->route('rproduct.index')->with('success','Created Banner ');

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
        $banner = related_gproduct::find($id);
        if ($banner) {
            # code...
            return view('backend.rproduct.edit',compact('banner'));
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
        $banner = Banner::find($id);
        if ($banner) {

        }else{
            return back()->with('error', 'error with id ');
        }
         //return $request->all();
       $this->validate($request,[
        'title'=>'string|required',
        //'slug'=>'string|required',
        'discreption'=>'string|nullable',
        'photo'=>'string|required',
        'status'=>'nullable|in:active,inactive',
        // 'status'=>'nullable|in:promo,banner',
        'type'=>'nullable|in:promo,banner,header',
        'bigTitle'=>'string|nullable',
        'smallTitle'=>'string|nullable',
        'name'=>'string|nullable',
        'youtube'=>'string|nullable',



       ]);
       $data=$request->all();
       $status=$banner->fill($data)->save();
       if ($status) {
        return redirect()->route('rproduct.index')->with('success','Updated Banner ');
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
        $banner = related_gproduct::find($id);
        if ($banner) {
            $status=$banner->delete();
            if ($status) {
                return redirect()->route('rproduct.index')->with('success',' Record Deleted');
            }
        }else{
            return back()->with('error', 'error with data ');
        }
    }
}
