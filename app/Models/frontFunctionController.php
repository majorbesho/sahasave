<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use App\Models\EmailVerification;
use Mail;

use Illuminate\Support\Str;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Mail\OrderMail;
use App\Models\Category;
use App\Models\LoadAddFromIndex;


class frontFunctionController extends Controller
{


    // Route::get('/addyourload', [App\Http\Controllers\Auth\Admin\sellerController::class, 'getaddyourload'])->name('gaddyourload');
    // Route::get('/addyourCar', [App\Http\Controllers\Auth\Admin\sellerController::class, 'getaddyourCar'])->name('gaddyourCar');
    // Route::get('/becomepartner', [App\Http\Controllers\Auth\Admin\sellerController::class, 'getBecomepartner'])->name('gbecomepartner');
    // Route::get('/searchload', [App\Http\Controllers\Auth\Admin\sellerController::class, 'getsearchload'])->name('gsearchload');

    public function getaddyourload()
    {


        return view('frontend.user.createLoad');
    }

    public function getaddyourCar()
    {

        //     ->orderBy('id', 'DESC')->get();
        return view('frontend.addyourload', compact('box'));
    }

    public function getBecomepartner()
    {
        //     ->orderBy('id', 'DESC')->get();
        return view('frontend.addyourload', compact('box'));
    }
    public function getsearchload()
    {
        //     ->orderBy('id', 'DESC')->get();
        return view('frontend.addyourload', compact('box'));
    }




    //Makeoffer
    public function Makeoffer($slug)
    {

        //return $gop;
        //     ->orderBy('id', 'DESC')->get();
        return view('frontend.frontfunction.makeoffer', compact(['box', 'gop']));
    }

    // Route::post('/requestforQuote', [App\Http\Controllers\Auth\Admin\sellerController::class, 'postrequestforQuote'])->name('requestforQuote');
    // Route::post('/addyourload', [App\Http\Controllers\Auth\Admin\sellerController::class, 'postaddyourload'])->name('addyourload');
    // Route::post('/addyourCar', [App\Http\Controllers\Auth\Admin\sellerController::class, 'postaddyourCar'])->name('addyourCar');
    // Route::post('/becomepartner', [App\Http\Controllers\Auth\Admin\sellerController::class, 'postBecomepartner'])->name('becomepartner');
    // Route::post('/searchload', [App\Http\Controllers\Auth\Admin\sellerController::class, 'postsearchload'])->name('searchload')



    /**
     * Show the form for requesting a quote.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */


    public function getrequestforQuote()
    {

        $categorys = Category::where(['status' => 'active'])->with('gproducts')->orderBy('id', 'DESC')->get();

        return view('frontend.rfq', compact('categorys'));
    }

    public function postrequestforQuote(Request $request)
    {
        //return $request->all();
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'weight' => 'nullable|numeric',
            'cat_id' => 'nullable|numeric',
            'user_id' => 'nullable|numeric',
            'lenght' => 'required|numeric',
            'origin' => 'required|string',
            'destination' => 'required|string',
            'date' => 'required|date',
            'price' => 'required|numeric|min:0',
        ]);



        $data = $request->all();
        $slug = Str::slug($request->input('name'));
        $slug_count = LoadAddFromIndex::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '-' . $slug;
        }
        $data['slug'] = $slug;

        $status = LoadAddFromIndex::create($data);
        if ($status) {
            return redirect()->route('rfqRss')->with('success', 'Created Load ');
        } else {
            return back()->with('error', 'somsthig wrong ');
        }
        // $allLoad =  LoadAddFromIndex::where(['status' => 'active']);


        // //     ->orderBy('id', 'DESC')->get();
        // return view('frontend.addyourload', compact('box', 'allLoad'));
    }


    public function rfqRss()
    {
        $logistic  = LoadAddFromIndex::orderBy('id', 'DESC')->get();
        $withcat = LoadAddFromIndex::with('cat')->orderBy('id', 'DESC')->get();
        return $withcat;
        return view('frontend.rfqRss', compact(['logistic ', 'withcat']));
    }

    public function postaddyourload()
    {
        //     ->orderBy('id', 'DESC')->get();
        return view('frontend.addyourload', compact('box'));
    }

    public function postaddyourCar()
    {
        //     ->orderBy('id', 'DESC')->get();
        return view('frontend.addyourload', compact('box'));
    }

    public function postBecomepartner()
    {
        //     ->orderBy('id', 'DESC')->get();
        return view('frontend.addyourload', compact('box'));
    }

    public function postsearchload()
    {
        //     ->orderBy('id', 'DESC')->get();
        return view('frontend.addyourload', compact('box'));
    }








    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
