<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\LoadPackage;
use App\Models\trucks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrokerLoadController extends Controller
{



    public function __construct()
    {
        $this->middleware('broker');
    }




    public function  trucksshow(Request $request)
    {
        // استعلام أساسي
        $query = trucks::with([
            'cat',
            'brand',
            'photos',
            'specification',
            'availabilities',
            'ratings',
        ]);

        // فلتر التوفر (Availabilities)
        if ($request->has('availability_filter') && $request->availability_filter === 'available') {
            $query->whereHas('availabilities', function ($q) {
                $q->where('start_date', '<=', now())
                    ->where('end_date', '>=', now());
            });
        } elseif ($request->has('availability_filter') && $request->availability_filter === 'not_available') {
            $query->whereDoesntHave('availabilities', function ($q) {
                $q->where('start_date', '<=', now())
                    ->where('end_date', '>=', now());
            });
        }

        // فلتر التقييمات (Ratings)
        if ($request->has('rating_filter')) {
            $rating = $request->rating_filter;
            $query->whereHas('ratings', function ($q) use ($rating) {
                $q->where('rating', '>=', $rating);
            });
        }

        // فلتر العلامة التجارية (Brand)
        if ($request->has('brand_filter')) {
            $brandId = $request->brand_filter;
            $query->where('brand_id', $brandId);
        }

        // تنفيذ الاستعلام مع التقسيم (Pagination)
        $trucks = $query->paginate(10);

        // استرجاع العلامات التجارية لعرضها في الفلتر
        $brands = Brand::all();

        return view('broker.trucks.trucks', compact('trucks', 'brands'));
    }

    public function  indextrucks($slug)
    {

        // استعلام أساسي
        $query = trucks::with([
            'cat',
            'brand',
            'photos',
            'specification',
            'availabilities',
            'ratings',
        ]);

        // فلتر التوفر (Availabilities)
        if ($slug->has('availability_filter') && $slug->availability_filter === 'available') {
            $query->whereHas('availabilities', function ($q) {
                $q->where('start_date', '<=', now())
                    ->where('end_date', '>=', now());
            });
        } elseif ($slug->has('availability_filter') && $slug->availability_filter === 'not_available') {
            $query->whereDoesntHave('availabilities', function ($q) {
                $q->where('start_date', '<=', now())
                    ->where('end_date', '>=', now());
            });
        }

        // فلتر التقييمات (Ratings)
        if ($slug->has('rating_filter')) {
            $rating = $slug->rating_filter;
            $query->whereHas('ratings', function ($q) use ($rating) {
                $q->where('rating', '>=', $rating);
            });
        }

        // فلتر العلامة التجارية (Brand)
        if ($slug->has('brand_filter')) {
            $brandId = $slug->brand_filter;
            $query->where('brand_id', $brandId);
        }

        // تنفيذ الاستعلام مع التقسيم (Pagination)
        $trucks = $query->paginate(10);


        // $truck = $trucks->(['slug' => $slug])->first();

        // استرجاع العلامات التجارية لعرضها في الفلتر
        $brands = Brand::all();
        return $trucks;
        return view('frontend.indextrucks', compact('trucks', 'brands'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $loads = LoadPackage::orderBy('id', 'DESC')
            ->paginate(20);

        return view('broker.loads.index', compact('loads'));
    }



    public function mytruck()
    {
        //
        $loads = trucks::where('added_by', auth()->guard('broker')->id())
            ->orderBy('id', 'DESC')
            ->paginate(20);

        return view('broker.loads.mytruck', compact('loads'));
    }

    public function details($id)
    {
        $load = LoadPackage::find($id);
        return response()->json([
            'description' => $load->description,
            'shipment' => $load->shipment,
            'paymentType' => $load->paymentType,
            'paymentStatus' => $load->paymentStatus,
            'dropDate' => $load->dropDate,
            'loadNotes' => $load->loadNotes,
        ]);
    }

    //brokermyloads
    public function brokermyloads()
    {
        $loads = LoadPackage::where('createdBy', auth()->guard('broker')->id())->orderBy('id', 'DESC')
            ->paginate(20);

        return view('broker.myloads', compact('loads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('broker.loads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // return $request->all();
    public function store(Request $request)
    {
        //return auth()->guard('shipper')->user();
        //dd(auth()->guard('shipper')->id());
        // Validate the request
        $validatedData = $request->validate([
            'title' => 'string|required',
            'discreption' => 'string|nullable',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate as an image file
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

        // Handle file upload
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('shipper/photos', 'public'); // Store the file in the 'public/photos' directory
        } else {
            $photoPath = null;
        }

        // Prepare data for saving
        $data = $request->all();
        $data['photo'] = $photoPath; // Save the file path in the database

        // Generate slug
        $slug = Str::slug($request->input('title'));
        $slug_count = LoadPackage::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '-' . $slug;
        }
        $data['slug'] = $slug;

        // Assign the current user as the creator
        $data['createdBy'] = auth()->guard('broker')->id();

        // Create the LoadPackage
        $status = LoadPackage::create($data);

        // Redirect with success or error message
        if ($status) {
            return redirect()->route('broker.loads.index')->with('success', 'LoadPackage created successfully.');
        } else {
            return back()->with('error', 'Something went wrong.');
        }
    }


    public function show($id)
    {

        $LoadPackage = LoadPackage::find($id);
        if ($LoadPackage) {

            return view('broker.loads.edite', compact('LoadPackage'));
        } else {
            return back()->with('error', 'error with id ');
        }
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
            return view('broker.loads.edite', compact('LoadPackage'));
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
        // Find the LoadPackage by ID
        $LoadPackage = LoadPackage::find($id);
        if (!$LoadPackage) {
            return back()->with('error', 'Error: LoadPackage not found.');
        }

        // Validate the request
        $this->validate($request, [
            'title' => 'string|required',
            'discreption' => 'string|nullable',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Updated validation rule
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

        // Handle file upload
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($LoadPackage->photo && Storage::disk('public')->exists($LoadPackage->photo)) {
                Storage::disk('public')->delete($LoadPackage->photo);
            }

            // Store the new photo
            $photo = $request->file('photo');
            $photoPath = $photo->store('shipper/photos', 'public'); // Store in 'public/shipper/photos'
        } else {
            // Keep the existing photo if no new photo is uploaded
            $photoPath = $LoadPackage->photo;
        }

        // Prepare data for update
        $data = $request->except('photo'); // Exclude photo from the request data
        $data['photo'] = $photoPath; // Add the photo path to the data array

        // Update the LoadPackage
        $status = $LoadPackage->fill($data)->save();

        if ($status) {
            return redirect()->route('broker.loads.index')->with('success', 'LoadPackage updated successfully.');
        } else {
            return back()->with('error', 'Something went wrong.');
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
                return redirect()->route('broker.loads.index')->with('success', ' Record Deleted');
            }
        } else {
            return back()->with('error', 'error with data ');
        }
    }
}
