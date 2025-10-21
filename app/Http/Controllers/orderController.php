<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // SELECT * FROM `orders`
        // INNER JOIN gop_orders
        // ON
        // gop_orders.order_id = orders.id
        // INNER JOIN group_products
        // ON
        // group_products.id=gop_orders.gop_id




        $orderData=DB::table('orders')


        ->join('gop_orders', 'gop_orders.order_id', '=', 'orders.id')

        ->join('group_products', 'group_products.id', '=', 'gop_orders.gop_id')

        ->select(
            'title',
            'status',
            'Caturl',
            'sdate',
            'edate',
            'price',
            'showPrice',
            'supplier',
            'orders.id','orders.created_at as o_created_at','order_id', 'user_id',
            'order_number',
            'total_amount',
            'coupon',
            'quantity',
            'email',
            'phone',
            'startdate',
            'enddate',
            'user_name',
            'payment_method',
            'payment_status',
            'condition',
            'empid',
            'product_type',
            'gop_orders.gop_id',
            'gop_orders.order_id',
            'gop_orders.qty as qty',

            )
        ->orderBy('orders.id','DESC')
        ->get();
        //return $orderData;
    $orders = order::orderBy('id','DESC')->get();
    //return $orderData;

    return view('backend.order.index',compact(['orders','orderData']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }


    public function orderStatus(Request $request)
    {
        $order = order::find($request->input('order_id'));
        if ($order) {
            if ($request->input('condition')=='paid') {
                foreach ($order->gproduct as  $item ) {
                    // $product =
                }
            } else {
                # code...
            }

        } else {
            # code...
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

        $order = order::find('id');
        if ($order) {
            return view('backend.art.edit',compact('order'));
        }
        abort(404);
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
    }
}
