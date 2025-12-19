<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\networks;

use App\Models\supplier;
use App\Models\User;
use App\Notifications\NewUserRegisterNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class sellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginFormSup()
    {
        return view('backend.auth.supplierlogin');
    }

    public function supplier_home()
    {
        return view('backend.sellerbackend.index');
    }
    public function loginFormpost(Request $request)
    {

        if (Auth::guard('supplier')
            ->attempt(['email' => $request->email, 'password' => $request->password])
        ) {
            return view('backend.sellerbackend.index')->with('Success', 'You Are Login');
        }
        //return back()->withInput($request->only('email'));
        return back()->with('Error', 'You Are Not Login');
    }
    public function showRegisterForm()
    {
        return view('backend.auth.supplierlogin');
    }
    public function suppDashboard(Request $request)
    {
        return redirect()->route('supplier.home')->with('success', 'Success Banner ');
    }
    public function ShowSupplierRegister1()
    {
        return view('backend.auth.ShowSupplierRegister1');
    }
    public function supplierRegister1Post(Request $request)
    {
        //$request->all();

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'min:6|required',
            // 'password_confirmation' => 'min:4',
            'title' => 'nullable|string',
            'phone' => 'nullable',
            'referral_code' => 'nullable',
        ]);
        //return $validator->all();
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }
        //return $request->all();
        $user = User::where('email', $request->email)->first();
        //return $user;
        if ($user) {
            // User already exists, redirect to login with a message
            return redirect()->route('login')->with('error', 'This email is already registered. Please login.');
        }



        $referral_code = Str::random(10);
        //return $request->all();
        if (!empty($request->referral_code)) {
            //return $request->all();
            // add the levels of ref
            $userData = supplier::where('referral_code', $request->referral_code)->get();
            //
            if (count($userData) > 0) {
                $userId  = supplier::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'title' => $request->title,

                    'phone' => $request->phone,
                    'referral_code' => $referral_code,
                    'ref_by' => $userData[0]['id'],
                ]);
                $nodex = supplier::where('referral_code', $request->referral_code);
                $node = supplier::find($userId->ref_by);
                $node->appendNode($userId);
                $data = $request->all();
                $userid = supplier::orderBy('id', 'DESC')->first();
                Session::put('supplier', $data['email']);
                Auth::login($userid);
                if ($userId) {
                    //return redirect()->route('verification', $userId);
                    return redirect()->route('backend.sellerbackend.index')->with('success', 'success  Welcome toSehaSave.com .com ');
                } else {

                    return back()->with('error', 'check your data Please ');
                }
            } else {
                //return $request->all();
                return back()->with('error', 'check your referral code Please Its Optional  ');
            }
            return $request->all();
        } else {
            //return $request->all();
            $userId  = supplier::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'title' => $request->title,
                // 'nationality' => $request->nationality,
                // 'dateOfbarth' => $request->dateOfbarth,
                'phone' => $request->phone,
                'referral_code' => $referral_code,
                'ref_by' => 0,


            ]);
            //return $request->all();
            $domain = URL::to('/');
            $url = $domain . '/referral-register?ref=' . $referral_code;
            $newData['url'] = $url;
            $newData['title'] = $request->phone;
            $newData['email'] = $request->email;
            $newData['title'] = 'Register';
            //  Mail::send('referralRegister', $newData, function ($message) use($newData) {

            //      $message->to ($newData['email'])->subject($newData['title']);

            //  });

            //$newData['pasword'] = $request->password;
            //return $referral_code;
            $data = $request->all();
            $userid = supplier::orderBy('id', 'DESC')->first();
            //return $userid;
            Session::put('user', $data['email']);

            Auth::login($userid);




            if ($userId) {
                //return redirect()->route('verification', $userId);
                return redirect()->route('supplier.home')->with('success', 'Success Banner ');
            } else {
                return back()->with('error', 'check your data Please ');
            }
        }
        $data = $request->all();
    }




    public function transaction()
    {

        $user = Auth::guard('supplier')->user();
        //dd($user);
        $categorys = Category::where(['status' => 'active'])->with('gproducts')->orderBy('id', 'DESC')->get();

        if ($user) {
            $userbil = DB::table('orders')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->join('gop_orders', 'orders.id', '=', 'gop_orders.order_id')
                ->where('orders.user_id', '=', auth('supplier')->user()->id)
                ->get();
            //return $userbil;
            return view('backend.sellerbackend.suppliersprofile.transaction', compact('user', 'categorys', 'userbil'));
        } else {
            return redirect()->route('home')->with('Login first Please and Acive your account   ');
        }
    }
    public function personalInformation()
    {
        $user = Auth::guard('supplier')->user();

        if ($user) {
            $userbil = DB::table('orders')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->join('gop_orders', 'orders.id', '=', 'gop_orders.order_id')
                ->join('group_products', 'group_products.id', '=', 'gop_orders.gop_id')

                ->where('orders.user_id', '=', Auth::guard('supplier')->user()->id);
            //return $userbil;
            $userbilx = DB::table('orders')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->join('gop_orders', 'orders.id', '=', 'gop_orders.order_id')
                ->join('group_products', 'group_products.id', '=', 'gop_orders.gop_id')

                ->where('orders.user_id', '=', Auth::guard('supplier')->user()->id)
                ->select(
                    'orders.created_at as orderDatelast',
                    'orders.order_number',
                    'orders.gop_id',
                    'orders.user_name',
                    'users.address',
                    'orders.note',
                    'orders.payment_method',
                    'orders.payment_status',
                    'orders.condition',
                    'orders.empid',
                    'orders.total_amount',
                    'orders.coupon',
                    'orders.delivery_charge',
                    'orders.quantity',
                    'orders.email',
                    'orders.phone',
                    'orders.startdate',
                    'orders.enddate',
                    'orders.sessoin_id',

                    'orders.product_type',
                    'orders.updated_at',
                    'users.name',
                    'users.email_verified_at',
                    'users.photo',
                    'users.phoneOtp_verified_at',
                    'users.nationality',
                    'users.dateOfbarth',
                    'users.password',
                    'users.provider',
                    'users.provider_id',
                    'users.referral_code',
                    'users.ref_by',
                    'users.no_of_refs',
                    'users.ref_level_id',
                    'users.phone_verfiy',
                    'users.is_verified',
                    'users.status',
                    'users.onesignal_device_id',
                    'users.remember_token',
                    'emp_code',
                    '_lft',
                    '_rgt',
                    'parent_id',
                    'order_id',
                    'qty',
                    'title',
                    'slug',
                    'discreption',
                    'Caturl',
                    'sdate',
                    'edate',
                    'stock',
                    'price',
                    'showPrice',
                    'periodID',
                    'showx',
                    // 'supplier',
                    // 'sandboxPriceID',
                    'conditaion',
                    // 'offer_price',
                    'discount',

                    'type',
                    'chk',
                    'dose',
                    'Directions',
                    'Ingredients',
                )
                ->get();
            //return $userbilx;


            $result = json_decode($userbilx, true);
            //    $empidcheck= DB::table('emps')
            //    ->get();

            //return $empidcheck;
            return view('backend.sellerbackend.suppliersprofile.personalInformation', compact('user', 'userbil', 'result', 'userbilx'));
        } else {
            return redirect()->route('home')->with('Login first Please and Acive your account   ');
        }
    }

    public function cartDetails()
    {
        return view('backend.auth.supplierlogin');
    }

    public function userlottery()
    {
        return view('backend.auth.supplierlogin');
    }
    public function addtruck()
    {
        return view('backend.sellerbackend');
    }





    public function userreferral()
    {
        return view('backend.auth.supplierlogin');
    }



    public function new_userreferral()
    {
        return view('backend.auth.supplierlogin');
    }



    public function refs()
    {
        return view('backend.auth.supplierlogin');
    }


    public function contact()
    {
        return view('backend.auth.supplierlogin');
    }
    public function graph()
    {
        return view('backend.auth.supplierlogin');
    }

    public function editinfo()
    {
        return view('backend.auth.supplierlogin');
    }

    public function editaccount()
    {
        return view('backend.auth.supplierlogin');
    }

    public function otp()
    {
        return view('backend.auth.supplierlogin');
    }

    public function sngilbranch()
    {
        return view('backend.auth.supplierlogin');
    }

    public function groupOfProduct()
    {
        return view('backend.auth.supplierlogin');
    }
}
