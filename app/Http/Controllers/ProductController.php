<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product=product::orderBy('id','DESC')->get();
        return view('backend.product.index',compact('product'));
    }
    public function productStatus(Request $request)
    {
        //dd($request->all());
        if ($request->mode==true) {
            DB::table('products')->where('id',$request->id)->update(['status'=>'active']);
        }else{
            DB::table('products')->where('id',$request->id)->update(['status'=>'inactive']);
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
        return view('backend.product.create');
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
        //
        $this->validate($request,[

            'title'=>'string|required',
            'cat_id'=>'required|exists:categories,id',
            'brand_id'=>'required|exists:brands,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'stok'=>'string|required',
            'price'=>'string|required',
            'offer_price'=>'string|required',
            'discount'=>'string|required',
            'Caturl'=>'string|required',
            'discreption'=>'string|nullable',
            'summary'=>'string|nullable',
            'photo'=>'string|required',
            'status'=>'nullable|in:active,inactive',
            'conditaion'=>'nullable|in:new,popular,winter',
            'type'=>'nullable|in:woman,kids,man',
            'group_products_id'=>'required|exists:group_products,id',
            'supplier_id'=>'required|exists:suppliers,id',
        ]);
           $data=$request->all();
           $slug =Str::slug($request->input('title'));
           $slug_count=product::where('slug',$slug)->count();
           if ($slug_count>0) {
            $slug =time().'-'.$slug;
           }
           $data['slug'] =$slug;
            //return $data;
            //return $request->all();
           $status=product::create($data);
           if ($status) {
            return redirect()->route('product.index')->with('success','Created Product ');

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
        $product = product::find($id);
        if ($product) {
            # code...
            return view('backend.product.edit',compact('product'));
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
        $product = product::find($id);
        if ($product) {

        }else{
            return back()->with('error', 'error with id ');
        }
         //return $request->all();
       $this->validate($request,[

        'title'=>'string|required',
        'cat_id'=>'required|exists:categories,id',
        'brand_id'=>'required|exists:brands,id',
        'child_cat_id'=>'nullable|exists:categories,id',
        'stok'=>'string|required',
        'price'=>'string|required',
        'offer_price'=>'string|required',
        'discount'=>'string|required',
        'Caturl'=>'string|required',
        'discreption'=>'string|nullable',
        'summary'=>'string|nullable',
        'photo'=>'string|required',
        'status'=>'nullable|in:active,inactive',
        'conditaion'=>'nullable|in:new,popular,winter',
        'type'=>'nullable|in:woman,kids,man',
        'group_products_id'=>'required|exists:group_products,id',
        'supplier_id'=>'required|exists:suppliers,id',

       ]);
       $data=$request->all();
       $status=$product->fill($data)->save();
       if ($status) {
        return redirect()->route('product.index')->with('success','Updated product ');
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
        $product = product::find($id);
        if ($product) {
            $status=$product->delete();
            if ($status) {
                return redirect()->route('product.index')->with('success',' Record Deleted');
            }
        }else{
            return back()->with('error', 'error with data ');
        }

    }
}
