<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\LoadPackage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;

class LoadPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $loadPackage = LoadPackage::orderBy('id', 'DESC')->get();
        return view('backend.loadPackage.index', compact('loadPackage'));
    }
    public function LoadPackageStatus(Request $request)
    {
        //dd($request->all());
        if ($request->mode == true) {
            DB::table('LoadPackages')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('LoadPackages')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'successfuly ', 'status' => true]);
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
        return view('backend.loadPackage.create');
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
        $this->validate($request, [

            'title' => 'string|required',
            'discreption' => 'string|nullable',
            'photo' => 'string|nullable',
            'status' => 'nullable|in:active,inactive',
            'totalItems' => 'integer|nullable',
            'totalDimensions' => 'nullable|string',
            'totalLength' => 'nullable|string',
            'totalWidth' => 'nullable|string',
            'totalHeight' => 'nullable|string',
            'weight' => 'numeric|nullable|between:0,99999999',
            'shipment' => 'nullable|string',
            'paymentType' => 'nullable|in:cod,prepaid,prepaid_cod,prepaid_prepaid',
            'paymentStatus' => 'nullable|in:pending,paid,failed',
            'paymentMethod' => 'nullable|in:cash,cheque,online,wire transfer',
            'paymentDate' => 'nullable|date',
            'paymentRef' => 'nullable|string',
            'trackingNumber' => 'nullable|string',
            'trackingStatus' => 'nullable|in:pending,delivered,delayed,cancelled,failed',
            'trackingUrl' => 'nullable|string',
            'loadType' => 'nullable|in:full,partial',
            'loadNumber' => 'nullable|string',
            'loadDate' => 'nullable|date',
            'loadTime' => 'nullable|string',
            'loadBy' => 'nullable|string',
            'loadTo' => 'nullable|string',
            'loadFrom' => 'nullable|string',
            'loadStatus' => 'nullable|string',
            'dropDate' => 'nullable|date',
            'dropTime' => 'nullable|string',
            'dropTo' => 'nullable|string',
            'dropFrom' => 'nullable|string',
            'dropStatus' => 'nullable|string',
            'dropApproval' => 'nullable|string',
            'dropNotes' => 'nullable|string',
            'loadApproval' => 'nullable|string',
            'loadNotes' => 'nullable|string',

        ]);
        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = LoadPackage::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '-' . $slug;
        }
        $data['slug'] = $slug;

        //return $data;
        //return $request->all();
        $status = LoadPackage::create($data);
        if ($status) {
            return redirect()->route('LoadPackage.index')->with('success', 'Created LoadPackage ');
        } else {
            return back()->with('error', 'somsthig wrong ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoadPackage  $loadPackage
     * @return \Illuminate\Http\Response
     */
    public function show(LoadPackage $loadPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoadPackage  $loadPackage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $LoadPackage = LoadPackage::find($id);
        if ($LoadPackage) {
            # code...
            return view('backend.LoadPackage.edit', compact('LoadPackage'));
        } else {
            return back()->with('error', 'error with id ');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoadPackage  $loadPackage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $LoadPackage = LoadPackage::find($id);
        if ($LoadPackage) {
        } else {
            return back()->with('error', 'error with id ');
        }
        //return $request->all();
        $this->validate($request, [

            'title' => 'string|required',
            'discreption' => 'string|nullable',
            'photo' => 'string|nullable',
            'status' => 'nullable|in:active,inactive',
            'totalItems' => 'integer|nullable',
            'totalDimensions' => 'nullable|string',
            'totalLength' => 'nullable|string',
            'totalWidth' => 'nullable|string',
            'totalHeight' => 'nullable|string',
            'weight' => 'numeric|nullable|between:0,99999999',
            'shipment' => 'nullable|string',
            'paymentType' => 'nullable|in:cod,prepaid,prepaid_cod,prepaid_prepaid',
            'paymentStatus' => 'nullable|in:pending,paid,failed',
            'paymentMethod' => 'nullable|in:cash,cheque,online,wire transfer',
            'paymentDate' => 'nullable|date',
            'paymentRef' => 'nullable|string',
            'trackingNumber' => 'nullable|string',
            'trackingStatus' => 'nullable|in:pending,delivered,delayed,cancelled,failed',
            'trackingUrl' => 'nullable|string',
            'loadType' => 'nullable|in:full,partial',
            'loadNumber' => 'nullable|string',
            'loadDate' => 'nullable|date',
            'loadTime' => 'nullable|string',
            'loadBy' => 'nullable|string',
            'loadTo' => 'nullable|string',
            'loadFrom' => 'nullable|string',
            'loadStatus' => 'nullable|string',
            'dropDate' => 'nullable|date',
            'dropTime' => 'nullable|string',
            'dropTo' => 'nullable|string',
            'dropFrom' => 'nullable|string',
            'dropStatus' => 'nullable|string',
            'dropApproval' => 'nullable|string',
            'dropNotes' => 'nullable|string',
            'loadApproval' => 'nullable|string',
            'loadNotes' => 'nullable|string',



        ]);
        $data = $request->all();
        $status = $LoadPackage->fill($data)->save();
        if ($status) {
            return redirect()->route('LoadPackage.index')->with('success', 'Updated LoadPackage ');
        } else {
            return back()->with('error', 'somsthig wrong ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoadPackage  $loadPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $LoadPackage = LoadPackage::find($id);
        if ($LoadPackage) {
            $status = $LoadPackage->delete();
            if ($status) {
                return redirect()->route('LoadPackage.index')->with('success', ' Record Deleted');
            }
        } else {
            return back()->with('error', 'error with data ');
        }
    }
}
