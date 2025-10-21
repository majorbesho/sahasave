<?php

namespace App\Http\Controllers\Supplier;


use App\Http\Controllers\Controller;
use App\Models\LoadPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



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
        $user_id = auth('supplier')->user()->id;
        $loadPackage = LoadPackage::orderBy('id', 'DESC')->get();
        //return $user_id;
        return view('backend.sellerbackend.loadPackage.index', compact('loadPackage', 'user_id'));
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
        return view('backend.sellerbackend.LoadPackage.create');
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

        //return $request->all();
        $status = LoadPackage::create($data);
        if ($status) {
            return redirect()->route('supplier-LoadPackage.index')->with('success', 'Created LoadPackage ');
        } else {
            return back()->with('error', 'somsthig wrong ');
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
        $LoadPackage = LoadPackage::find($id);
        if ($LoadPackage) {
            # code...
            return view('backend.sellerbackend.LoadPackage.edit', compact('LoadPackage'));
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
            return redirect()->route('supplier-LoadPackage.index')->with('success', 'Updated LoadPackage ');
        } else {
            return back()->with('error', 'somsthig wrong ');
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
        $LoadPackage = LoadPackage::find($id);
        if ($LoadPackage) {
            $status = $LoadPackage->delete();
            if ($status) {
                return redirect()->route('supplier-LoadPackage.index')->with('success', ' Record Deleted');
            }
        } else {
            return back()->with('error', 'error with data ');
        }
    }
}
