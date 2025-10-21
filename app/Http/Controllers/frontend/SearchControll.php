<?php

namespace App\Http\Controllers\frontend;

use App\Models\Trauck;
use App\Models\trucks;
use App\Models\LoadPackage;
use Illuminate\Http\Request;
use App\Models\LoadAddFromIndex;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\TruckSubType;
use App\Models\TruckType;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Return_;

class SearchControll extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search()
    {
        return view('frontend.searchresult');
    }


    public function searchloads()
    {

        $category = Category::where(['status' => 'active'])->orderBy('id', 'DESC')->get();

        $loadPackage = LoadPackage::with([
            'shipper',
            'truckType' => function ($query) {
                $query->select('id', 'name');
            },
            'truckSubType' => function ($query) {
                $query->select('id', 'name', 'capacity');
            }
        ])->get();

        $truckTypes = TruckType::with(['subTypes' => function ($query) {
            $query->where('status', 'active')->select('id', 'truck_type_id', 'name', 'capacity');
        }])->where('status', 'active')->get(['id', 'name']);
        // return $loadPackage;
        return view('frontend.searchloads', compact([
            'loadPackage',
            'category',
            'truckTypes'
        ]));
    }


    public function showBySlug($slug)
    {
        $shipment = LoadPackage::with(['shipper', 'truckType', 'truckSubType'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.shipments_show', compact('shipment'));
    }



    public function searchTrucks()
    {
        $category = Category::where(['status' => 'active'])->orderBy('id', 'DESC')->get();
        //return $category;




        $trucks = trucks::with([
            'brand',
            'cat',
            'photos',
            'specification',
            'availabilities',
            'ratings.user' // تحميل مستخدمي التقييمات
        ])
            ->when(request('price_min'), function ($query) {
                $query->where('price', '>=', request('price_min'));
            })
            ->when(request('price_max'), function ($query) {
                $query->where('price', '<=', request('price_max'));
            })
            ->when(request('truck_type'), function ($query) {
                $query->where('truck_type', request('truck_type'));
            })
            ->when(request('location_city'), function ($query) {
                $query->where('location_city', request('location_city'));
            })
            ->when(request('condition'), function ($query) {
                $query->where('condition', request('condition'));
            })
            ->orderBy(request('sort_by', 'created_at'), request('sort_dir', 'desc'))
            ->paginate(request('per_page', 15));
        // return $trucks;
        return view('frontend.searchTrucks', compact(['trucks', 'category']));
    }




    public function searchResult(Request $request)
    {

        $query = LoadPackage::query()->with(['truckType', 'truckSubType']);

        // فلترة حسب الموقع
        if ($request->filled('location_from')) {
            $query->where('loadFrom', 'like', '%' . $request->input('location_from') . '%');
        }

        if ($request->filled('location_to')) {
            $query->where('loadTo', 'like', '%' . $request->input('location_to') . '%');
        }

        // فلترة حسب نوع الشاحنة
        if ($request->filled('truck_type_id')) {
            $query->where('truck_type_id', $request->input('truck_type_id'));
        }

        // فلترة حسب النوع الفرعي للشاحنة
        if ($request->filled('sub_truck_type_id')) {
            $query->where('sub_truck_type_id', $request->input('sub_truck_type_id'));
        }

        // فلترة حسب الوزن
        if ($request->filled('weight') && $request->input('weight') > 0) {
            $query->where('weight', '>=', $request->input('weight'));
        }

        // فلترة حسب الطول
        if ($request->filled('length') && $request->input('length') > 0) {
            $query->where('totalLength', '>=', $request->input('length'));
        }

        // فلترة حسب السعر
        if ($request->filled('price') && $request->input('price') > 0) {
            $query->where('shipment', '<=', $request->input('price'));
        }

        $packages = $query->paginate(10);
        $truckTypes = TruckType::all();
        $truckSubTypes = TruckSubType::all();

        return view('frontend.indexloadresults', [
            'packages' => $packages,
            'truckTypes' => $truckTypes,
            'truckSubTypes' => $truckSubTypes,
            'searchParams' => $request->all()
        ]);
    }

    public function getCities(Request $request)
    {
        $term = $request->input('term');
        $field = $request->input('field', 'loadFrom');

        $cities = LoadPackage::query()
            ->where($field, 'LIKE', $term . '%')  // البحث عن المدن التي تبدأ بالحرف المدخل
            ->groupBy($field)
            ->pluck($field)
            ->toArray();

        return response()->json($cities);
    }


    public function getCitiesTo(Request $request)
    {
        $term = $request->input('term');
        $field = $request->input('field', 'dropFrom');

        $cities = LoadPackage::query()
            ->where($field, 'LIKE', $term . '%')
            ->groupBy($field)
            ->pluck($field)
            ->toArray();

        return response()->json($cities);
    }



    public function getCitiesLoadTo(Request $request)
    {
        $term = $request->input('term');
        $field = $request->input('field', 'location_country');

        $cities = trucks::query()
            ->where($field, 'LIKE', $term . '%')
            ->groupBy($field)
            ->pluck($field)
            ->toArray();

        return response()->json($cities);
    }


    public function getCitiesLoadfrom(Request $request)
    {
        $term = $request->input('term');
        $field = $request->input('field', 'location_city');

        $cities = trucks::query()
            ->where($field, 'LIKE', $term . '%')
            ->groupBy($field)
            ->pluck($field)
            ->toArray();

        return response()->json($cities);
    }

    // public function searchResult(Request $request)
    // {

    //     //return request()->all();
    //     $query = LoadPackage::query();


    //     if ($request->filled('location_from')) {
    //         $query->where('loadFrom', 'like', '%' . $request->input('location_from') . '%');
    //     }
    //     //return dd($query);


    //     if ($request->filled('location_to')) {
    //         $query->where('loadTo', 'like', '%' . $request->input('location_to') . '%');
    //     }

    //     if ($request->filled('cat_id')) {
    //         $query->where('cat_id', $request->input('cat_id'));
    //     }

    //     // استخدم where للقيم الرقمية مع التحقق من أنها أكبر من الصفر
    //     if ($request->filled('weight') && $request->input('weight') > 0) {
    //         $query->where('weight', '>=', $request->input('weight'));
    //     }

    //     if ($request->filled('length') && $request->input('length') > 0) {
    //         $query->where('totalLength', '>=', $request->input('length'));
    //     }

    //     if ($request->filled('price') && $request->input('price') > 0) {
    //         $query->where('shipment', '<=', $request->input('price'));
    //     }


    //     // $query->where('loadStatus', 'active')
    //     // ->where('loadApproval', 'approved')
    //     //;

    //     // أضف هذا لرؤية الاستعلام النهائي (للت debugging)
    //     // \Log::info($query->toSql());
    //     // \Log::info($query->getBindings());

    //     $packages = $query->paginate(10);
    //     $categories = Category::all();

    //     return view('frontend.indexloadresults', [
    //         'packages' => $packages,
    //         'categories' => $categories,
    //         'searchParams' => $request->all()
    //     ]);
    // }

    public function show($slug)
    {
        // Find the package by slug or fail with 404
        $package = LoadPackage::where('slug', $slug)->firstOrFail();

        return view('frontend.package_details', compact('package'));
    }


    //Loads
    public function searchLoadsResult(Request $request)
    {
        //return $request->all();


        $query = trucks::query();

        // تصفية حسب الموقع (بحث مرن أكثر)
        if ($request->filled('location_from')) {
            $query->where(function ($q) use ($request) {
                $q->where('location_country', 'like', '%' . $request->location_from . '%')
                    ->orWhere('location_city', 'like', '%' . $request->location_from . '%')
                    ->orWhere('location_country', 'like', '%' . strtolower($request->location_from) . '%')
                    ->orWhere('location_city', 'like', '%' . strtolower($request->location_from) . '%');
            });
        }

        if ($request->filled('location_to')) {
            $query->where(function ($q) use ($request) {
                $q->where('location_country', 'like', '%' . $request->location_to . '%')
                    ->orWhere('location_city', 'like', '%' . $request->location_to . '%')
                    ->orWhere('location_country', 'like', '%' . strtolower($request->location_to) . '%')
                    ->orWhere('location_city', 'like', '%' . strtolower($request->location_to) . '%');
            });
        }

        // تصفية حسب الفئة
        if ($request->filled('cat_id')) {
            $query->where('cat_id', $request->cat_id);
        }

        // تصفية حسب الوزن (قيمة تقريبية)
        if ($request->filled('weight')) {
            $query->where('weight', '>=', $request->weight * 0.9)
                ->where('weight', '<=', $request->weight * 1.1);
        }

        // تصفية حسب الطول (قيمة تقريبية)
        if ($request->filled('length')) {
            $query->where('length', '>=', $request->length * 0.9)
                ->where('length', '<=', $request->length * 1.1);
        }

        // تصفية حسب السعر (نطاق سعري)
        if ($request->filled('price')) {
            $query->where('price', '<=', $request->price * 1.2);
        }

        // فقط الشاحنات النشطة (مع إمكانية عرض غير النشطة للاختبار)
        if (app()->environment('local')) {
            // في بيئة التطوير، عرض جميع الشاحنات
            $query->whereIn('status', ['active', 'inactive', 'pending']);
        } else {
            // في بيئة الإنتاج، عرض الشاحنات النشطة فقط
            $query->where('status', 'active');
        }

        // تسجيل الاستعلام للفحص
        \DB::enableQueryLog();
        $trucks = $query->paginate(10); // استخدام التقسيم للنتائج
        \Log::debug('Search Query:', \DB::getQueryLog());

        return view('frontend.indexloadresultsnew', [
            'trucks' => $trucks,
            'categories' => Category::all(),
            'searchParams' => $request->all()
        ]);
    }



    protected function applyFilters($query, $filters)
    {
        // فلترة حسب الموقع (من)
        if (!empty($filters['location_from'])) {
            $query->where('loadFrom', 'LIKE', '%' . $filters['location_from'] . '%');
        }

        // فلترة حسب الموقع (إلى)
        if (!empty($filters['location_to'])) {
            $query->where('loadTo', 'LIKE', '%' . $filters['location_to'] . '%');
        }

        // فلترة حسب الوزن
        if (!empty($filters['weight'])) {
            $query->where('weight', '>=', $filters['weight']);
        }

        // فلترة حسب الطول
        if (!empty($filters['length'])) {
            $query->where('totalLength', '>=', $filters['length']);
        }

        // فلترة حسب السعر
        if (!empty($filters['price'])) {
            $query->where(function ($q) use ($filters) {
                $q->whereHas('shipment', function ($subQuery) use ($filters) {
                    $subQuery->where('price', '<=', $filters['price']);
                });
            });
        }

        // فلترة حسب نوع الحمولة (إذا كانت هناك علاقة)
        if (!empty($filters['cat_id'])) {
            $query->where('loadType', $filters['cat_id']);
        }

        // فلترة حسب الحمولات النشطة فقط
        $query->where('status', 'active');
    }


    public function reslutofindexsearch(Request $request)
    {
        //return $request->all();
        $searchTerm = $request->input('inputserch');
        //return $searchTerm;
        // Get all table names from the database, excluding 'users' and 'admins'
        $tables = DB::select('SHOW TABLES');
        $tableNames = array_column($tables, 'Tables_in_' . env('DB_DATABASE'));
        //$tableNames = array_diff($tableNames, ['users', 'admins']);
        $results = [];
        //return $tableNames;
        foreach ($tableNames as $tableName) {
            // Dynamically build the query for each table
            $query = "SELECT * FROM `{$tableName}` WHERE ";
            // Check for text columns and add conditions accordingly

            $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

            $textColumns = array_filter($columns, function ($column) {
                return in_array(strtolower($column), ['varchar', 'text', 'longtext', 'mediumtext', 'string']);
            });
            //return $tableName;
            $whereClauses = [];

            foreach ($textColumns as $column) {
                $whereClauses[] = "`{$column}` LIKE '%{$searchTerm}%'";
            }
            var_dump($textColumns);
            if (!empty($whereClauses)) {
                $query .= implode(' OR ', $whereClauses);
                $tableResults = DB::select($query);
                if (!empty($tableResults)) {
                    $results[$tableName] = $tableResults;
                }
            }
        }
        //return $results;
        return view('search_results', ['results' => $results]);
    }

    public function index()
    {
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


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
