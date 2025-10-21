<?php

namespace App\Http\Controllers\Truck;

use App\Http\Controllers\Controller;
use App\Models\trucks;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $trucks = trucks::with([
            'categories',       // الفئات
            'brand',            // العلامة التجارية
            'photos',           // الصور
            'specification',    // المواصفات
            'availabilities',   // التوافر
            'ratings',          // التقييمات
        ])->get();

        // إرجاع البيانات إلى العرض (View)
        return view('trucks.index', compact('trucks'));
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trucks  $trucks
     * @return \Illuminate\Http\Response
     */
    public function show(Trucks $trucks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trucks  $trucks
     * @return \Illuminate\Http\Response
     */
    public function edit(Trucks $trucks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trucks  $trucks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trucks $trucks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trucks  $trucks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trucks $trucks)
    {
        //
    }
}
