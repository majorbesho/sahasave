<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Coupon;
use Illuminate\Support\Str;


class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons=coupon::orderBy('id','DESC')->get();
        return view('backend.coupon.index',compact('coupons'));
    }
    public function couponsStatus(Request $request)
    {
        //dd($request->all());
        if ($request->mode==true) {
           DB::table('coupons')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('coupons')->where('id',$request->id)->update(['status'=>'inactive']);

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
        return view('backend.coupon.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //       'code','title', 'type', 'status', 'value'

        $this->validate($request,[
            'title'=>'string|required',
            'code'=>'string|required',
            //'slug'=>'string|required',            $table->enum('type', ['fixed', 'precent'])->default( 'fixed');

            'status'=>'nullable|in:active,inactive',
            'type'=>'nullable|in:fixed,precent',
            'value'=>'required|numeric',
           ]);
           $data=$request->all();
        //    $slug =Str::slug($request->input('title'));
        //    $slug_count=Banner::where('slug',$slug)->count();
        //    if ($slug_count>0) {
        //     $slug =time().'-'.$slug;
        //    }
        //    $data['slug'] =$slug;
            //return $data;
            //return $request->all();
           $status=coupon::create($data);
           if ($status) {
            return redirect()->route('coupon.index')->with('success','Created Coupon ');

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
        //+
        $coupon = coupon::find($id);
        if ($coupon) {
            # code...
            return view('backend.coupon.edit',compact('coupon'));
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
        $coupon = coupon::find($id);
        if ($coupon) {

        }else{
            return back()->with('error', 'error with id ');
        }
         //return $request->all();
       $this->validate($request,[
        'title'=>'string|required',
        'code'=>'string|required',
        //'slug'=>'string|required',            $table->enum('type', ['fixed', 'precent'])->default( 'fixed');

        'status'=>'nullable|in:active,inactive',
        'type'=>'nullable|in:fixed,precent',
        'value'=>'required|numeric',



       ]);
       $data=$request->all();
       $status=$coupon->fill($data)->save();
       if ($status) {
        return redirect()->route('coupon.index')->with('success','Updated coupon ');
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
        $coupon = coupon::find($id);
        if ($coupon) {
            $status=$coupon->delete();
            if ($status) {
                return redirect()->route('coupon.index')->with('success',' Record Deleted');
            }
        }else{
            return back()->with('error', 'error with data ');
        }
    }
}
