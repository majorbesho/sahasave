<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\about;
use App\Models\art;
use App\Models\Banner;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\client;
use App\Models\media;
use App\Models\order;
use App\Models\product;
use App\Models\setting;
use App\Models\team;
use App\Models\Faq;
use App\Models\testim;
use App\Models\User;
use App\Models\winner;
use App\Models\networks;
use App\Notifications\NewUserNotification;
use App\Notifications\NewUserRegisterNotification;
use Illuminate\Contracts\Session\Session as SessionSession;
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
use App\Models\Appointment;
use App\Models\Category;
use App\Models\Emp as ModelsEmp;
use Kalnoy\Nestedset\NodeTrait;
use Kalnoy\Nestedset\NestedSet;
use Illuminate\Support\Facades\Validator;


use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use App\Models\Emp;
use App\Models\NewsletterSubscriber;
use App\Models\Specialty;
use Illuminate\Support\Facades\Cache;

// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;

// OR
use Artesaos\SEOTools\Facades\SEOTools;
use App\Models\Blog;

use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

use Share;

// OR for joedixon/laravel-social-share
use JD\Laradit\SocialShare;

class IndexController extends Controller
{
    //   use SEOToolsTrait;
    /**wewewewe
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  user.auth


    public function homex()
    {
        SEOMeta::setTitle('SehaSave.comHome');
        SEOMeta::setDescription('SehaSave.com   ');
        SEOMeta::setCanonical('http://SehaSave.com/');

        OpenGraph::setDescription('SehaSave.com   ');
        OpenGraph::setTitle('SehaSave.com ');
        OpenGraph::setUrl('http://SehaSave.com/');
        OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle('SehaSave.com');
        // TwitterCard::setSite('@LuizVinicius73');

        JsonLd::setTitle('SehaSave.com');
        JsonLd::setDescription('SehaSave.com ');
        JsonLd::addImage('http://SehaSave.com');



        $categories = Category::featured()
            ->active()
            ->orderBy('sort_order')
            ->get();

        $stats = Cache::remember('home_page_stats', 1800, function () {
            return $this->getHomePageStats();
        });

        // $specialties = Specialty::withCount(['activeDoctors as doctors_count'])
        //     ->featured()
        //     ->active()
        //     ->ordered()
        //     ->take(8)
        //     ->get();

        $specialties = Specialty::withCount(['activeVerifiedDoctors as doctors_count'])
            ->featured()
            ->active()
            ->ordered()

            ->get();
        //return $specialties;

        $date = \Carbon\Carbon::now()->addDays(7);

        $client = client::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('6')->get();
        $arts = art::where(['status' => 'active'])->orderBy('id', 'DESC')->get();
        $setting = setting::orderBy('id', 'DESC')->limit('1')->get();
        $testim = testim::orderBy('id', 'DESC')->limit('8')->get();
        $branch = Branch::orderBy('id', 'DESC')->limit('8')->get();
        $user = User::where(['status' => 'active'])->orderBy('id', 'DESC')->get();
        $featuredDoctors = Cache::remember('home_featured_doctors', 3600, function () {
            return User::with(['doctorProfile', 'schedules'])
                ->where('role', 'doctor')
                ->where('status', 'active')
                ->whereHas('doctorProfile', function ($query) {
                    $query->where('is_featured', true)
                        ->where('is_verified', true)
                        ->where('accepting_new_patients', true);
                })
                ->withCount(['doctorAppointments as total_appointments'])
                ->join('doctor_profiles', 'users.id', '=', 'doctor_profiles.doctor_id')
                ->orderByDesc('doctor_profiles.average_rating')
                ->select('users.*') // تأكد من تحديد أعمدة users فقط
                ->limit(10)
                ->get();
        });

        $recentBlogs = Blog::with(['category'])
            ->published()
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();

        // الحصول على الأسئلة الشائعة النشطة
        $locale = app()->getLocale(); // 'ar' أو 'en'

        // الحصول على الـ FAQs مع الترجمات
        $faqs = Faq::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->active()
            ->ordered()
            ->take(6)
            ->get();



        // popular


        if (auth()->user()) {
            if (is_null(auth()->user()->email_verified_at) or is_null(auth()->user()->phoneOtp_verified_at)) {
                return view('frontend.index', compact([
                    //'banners',
                    // 'brands',
                    'client',
                    'arts',
                    'setting',
                    'testim',
                    'branch',
                    'stats',
                    'user',
                    // 'shareComponent',
                    'categories',
                    'specialties',
                    'specialties',
                    'featuredDoctors',
                    'recentBlogs',
                    'faqs'
                    //'upcoming',
                    // 'banner',
                    //'bannePromo',
                ]))->with('error', ' Please active your account ');
            }
        } else {
            return view('frontend.index', compact([
                //'banners',
                //'brands',
                'client',
                'arts',
                'setting',
                'testim',
                'branch',
                'stats',
                'user',
                // 'shareComponent',
                'categories',
                'specialties',

                'featuredDoctors',
                'recentBlogs',
                'faqs',
                //'upcoming',
                //'banner',
                //'countOfOrder',
                //'bannePromo',
            ]));
        }
    }


    public function toggleFavorite(Request $request, $doctorId)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Please login to add favorites'], 401);
        }

        $patient = auth()->user();

        // Check if doctor exists and is actually a doctor
        $doctor = User::where('id', $doctorId)->where('role', 'doctor')->first();

        if (!$doctor) {
            return response()->json(['error' => 'Doctor not found'], 404);
        }

        // Use the favorites table directly
        $isFavorite = DB::table('favorites')
            ->where('patient_id', $patient->id)
            ->where('doctor_id', $doctorId)
            ->exists();

        if ($isFavorite) {
            DB::table('favorites')
                ->where('patient_id', $patient->id)
                ->where('doctor_id', $doctorId)
                ->delete();
            return response()->json(['status' => 'removed', 'message' => 'Doctor removed from favorites']);
        } else {
            DB::table('favorites')
                ->insert([
                    'patient_id' => $patient->id,
                    'doctor_id' => $doctorId,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            return response()->json(['status' => 'added', 'message' => 'Doctor added to favorites']);
        }
    }



    private function getHomePageStats()
    {
        return [
            // إجمالي المواعيد المكتملة
            'total_appointments' => Appointment::whereIn('status', ['completed', 'finished'])->count(),

            // إجمالي المواعيد (للعرض في الـ banner)
            'total_appointments_count' => Appointment::count(),

            // متوسط التقييمات
            'average_rating' => $this->getAverageRating(),

            // إجمالي المرضى الراضين (المستخدمين النشطين)
            'satisfied_patients' => User::where('role', 'patient')
                ->where('status', 'active')
                ->count(),

            // عدد الأطباء النشطين
            'active_doctors' => User::where('role', 'doctor')
                ->where('status', 'active')
                ->count(),

            // آخر الأطباء للمعاينة (للأفاتارز)
            'recent_doctors' => User::where('role', 'doctor')
                ->where('status', 'active')
                ->with('doctorProfile')
                ->take(3)
                ->get(),

            // آخر المرضى (للأفاتارز)
            'recent_patients' => User::where('role', 'patient')
                ->where('status', 'active')
                ->take(3)
                ->get()
        ];
    }

    private function getAverageRating()
    {
        // إذا كان لديك جدول ratings:
        // return \App\Models\Rating::avg('rating') ?? 5.0;

        // أو إذا كان لديك في جدول appointments:
        $avgRating = Appointment::whereNotNull('rating')
            ->avg('rating');

        return round($avgRating ?? 5.0, 1);
    }

    // دالة البحث عن الأطباء
    public function searchDoctors(Request $request)
    {
        $search = $request->input('search', '');
        $location = $request->input('location', '');
        $date = $request->input('date', '');

        // البحث الأساسي عن الأطباء مع التأكد من وجود doctorProfile
        $doctors = User::where('role', 'doctor')
            ->where('status', 'active')
            ->whereHas('doctorProfile') // فقط الأطباء الذين لديهم ملف طبي
            ->with(['doctorProfile', 'medicalCenters'])
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhereHas('doctorProfile', function ($profileQuery) use ($search) {
                            $profileQuery->where('specialization', 'like', "%{$search}%")
                                ->orWhere('medical_school', 'like', "%{$search}%")
                                ->orWhereJsonContains('qualifications', $search);
                        });
                });
            })
            ->when($location, function ($query) use ($location) {
                return $query->where(function ($q) use ($location) {
                    $q->where('address', 'like', "%{$location}%")
                        ->orWhereHas('medicalCenters', function ($centerQuery) use ($location) {
                            $centerQuery->where('name', 'like', "%{$location}%")
                                ->orWhere('address', 'like', "%{$location}%")
                                ->orWhere('city', 'like', "%{$location}%");
                        });
                });
            })
            ->orderBy('name')
            ->paginate(10);

        $totalDoctors = $doctors->total();

        return view('frontend.doctors-search', compact('doctors', 'search', 'location', 'date', 'totalDoctors'));
    }

    // دالة لتفريغ الـ Cache عند حدوث تغييرات
    public function clearHomeCache()
    {
        Cache::forget('home_page_stats');
        return response()->json(['message' => 'Home cache cleared successfully']);
    }

    public function ref_user() {}
    public function productlib()
    {


        return view('frontend.pages.productlib');
    }

    public function userAuth()
    {

        Session::put('url.intended', URL::previous());
        return view('frontend.user.auth',);
    }




    public function loginsubmit(Request $request)
    {
        //return $request->all();
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'active',
        ])) {
            //return $request->all();
            Session::put('user', $request->email);
            if (Session::get('url.intended')) {

                if (auth()->user()->is_verified == 0) {
                    // $user = User::where('email', $request->email)->first();
                    // $otpData = EmailVerification::where('otp', $request->otp)->first();

                    // return redirect()->route('verification.noticex')->with('good', 'Login Susseccfule');
                    return redirect()->route('home')->with('good', 'Login Susseccfule');
                } else {
                    return redirect()->route('home')->with('good', 'Login Susseccfule');
                }
            } else {
                return back()->with('error', 'error in login ');
            }
        } else {
            return back()->with('error', 'error in login ');
        }
    }
    //user.register
    public function userRegister()
    {

        return view('frontend.register_temp');
    }



    public function registerSubmit(Request $request)
    {
        //return $request->all();
        //dd($request);

        //$userAll = User::select('*')->with('getrefby')->get();
        $this->validate($request, [
            'email' => 'unique:users|email|required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:4',
            'name' => 'nullable|string',
            'nationality' => 'nullable',
            'dateOfbarth' => 'nullable',
            'phone' => 'nullable',
            'referral_code' => 'nullable',
        ]);
        //return $request->all();
        $referral_code = Str::random(10);

        if (!empty($request->referral_code)) {
            //return $request->referral_code;

            // add the levels of ref
            $userData = User::where('referral_code', $request->referral_code)->get();
            //
            //return $userData;
            $usernetwork =  networks::with('user')
                ->where('parent_user_id', [$userData[0]['id']])
                ->get();
            //return $request->all();
            if (count($userData) > 0) {
                $userId  = User::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'name' => $request->name,
                    'nationality' => $request->nationality,
                    'dateOfbarth' => $request->dateOfbarth,
                    'phone' => $request->phone,
                    'referral_code' => $referral_code,
                    'referred_by' => $userData[0]['id'],
                ]);

                // Increment referral count for the referrer
                $userData[0]->increment('referral_count');

                $data = $request->all();
                $userid = User::orderBy('id', 'DESC')->first();
                Session::put('user', $data['email']);

                Auth::login($userid);

                if ($userId) {
                    return redirect()->route('home')->with('success', 'success  Welcome to SehaSave.com ');
                } else {
                    return back()->with('error', 'check your data Please ');
                }
            } else {
                return back()->with('error', 'check your data Please ');
            }
            //return $request->all();
        } else {
            $userId  = user::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => $request->name,
                'nationality' => $request->nationality,
                'dateOfbarth' => $request->dateOfbarth,
                'phone' => $request->phone,
                'referral_code' => $referral_code,
                'referred_by' => null,

            ]);
            //return $request->all();
            $domain = URL::to('/');
            $url = $domain . '/referral-register?ref=' . $referral_code;
            $newData['url'] = $url;
            $newData['name'] = $request->phone;
            $newData['email'] = $request->email;
            $newData['title'] = 'Register';
            //  Mail::send('referralRegister', $newData, function ($message) use($newData) {

            //      $message->to ($newData['email'])->subject($newData['title']);

            //  });

            //$newData['pasword'] = $request->password;
            //return $referral_code;
            $data = $request->all();
            $userid = User::orderBy('id', 'DESC')->first();
            //return $userid;
            Session::put('user', $data['email']);

            Auth::login($userid);



            if ($userId) {
                //return redirect()->route('verification', $userId);
                return redirect()->route('home')->with('success', 'success  Welcome toSehaSave.com ');
            } else {
                return back()->with('error', 'check your data Please ');
            }
        }


        $data = $request->all();

        // $notification->notify(new NewUserRegisterNotification($userId));
        // // return redirect()->back()->with('status','Your deposit was successful!');
    }

    //referralRegister



    public function referralRegister(Request $request)
    {
        //return $request->all();

        if (isset($request->ref)) {
            $referral = $request->ref;
            $userData = User::where('referral_code', $referral)->get();
            if (count($userData)) {
                return view('frontend.user.authref', compact('referral'));
            } else {

                return back()->with('error', 'check your data Please ');
            }
        } else {
            return redirect('/');
        }
    }
    //new-userreferral




    public function verification($id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect('/');
        }
        $email = $user->email;

        $this->sendOtp($user); //OTP SEND
        //return $user;

        return view('frontend.verification', compact('email'));
    }

    public function verifiedOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $otpData = EmailVerification::where('otp', $request->otp)->first();

        if (!$otpData) {
            return response()->json(['success' => false, 'msg' => 'You entered wrong OTP']);
        } else {

            $currentTime = time();
            $time = $otpData->created_at;

            if ($currentTime >= $time && $time >= $currentTime - (90 + 5)) { //90 seconds
                User::where('id', $user->id)->update([
                    'is_verified' => 1
                ]);
                return response()->json(['success' => true, 'msg' => 'Mail has been verified']);
            } else {
                return response()->json(['success' => false, 'msg' => 'Your OTP has been Expired']);
            }
        }
    }

    public function resendOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $otpData = EmailVerification::where('email', $request->email)->first();

        $currentTime = time();
        $time = $otpData->created_at;

        if ($currentTime >= $time && $time >= $currentTime - (90 + 5)) { //90 seconds
            return response()->json(['success' => false, 'msg' => 'Please try after some time']);
        } else {

            $this->sendOtp($user); //OTP SEND
            return response()->json(['success' => true, 'msg' => 'OTP has been sent']);
        }
    }




    //logout
    public function userlogout()
    {

        Cart::instance('shopping')->destroy();
        Session::forget('user');
        Session::forget('shopping');
        Session::forget('checkout1');

        Auth::logout();
        return redirect()->route('home')->with('success', 'success Logout See you soon ');
    }




    public function editinfo(Request $request, $id)
    {
        //return $request->all();
        $user = user::where('id', $id)->update([
            'name' => $request->name,
            'dateOfbarth' => $request->dateOfbarth,
            'address' => $request->address,
            'nationality' => $request->nationality,
            'phone' => $request->phone,
        ]);
        if ($user) {
            return back()->with('sussecc', 'your personal data has ben updated ');
        } else {
            return back()->with('error', 'somthoing wrong ');
        }
    }





    public function dashboard(Request $request)
    {
        //return $request->all();
        $user = Auth::user();

        if ($user) {
            $userbil = DB::table('orders')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->join('gop_orders', 'orders.id', '=', 'gop_orders.order_id')
                ->join('group_products', 'group_products.id', '=', 'gop_orders.gop_id')

                ->where('orders.user_id', '=', auth()->user()->id)->get();
            //return  $userbil;
            return view('frontend.user.dashboard', compact('user', 'userbil'));
        } else {
            return redirect()->route('home')->with('Login first Please and Acive your account   ');
        }
    }

    public function userDashboard()
    {

        $user = Auth::user();



        return view('frontend.user.dashboard', compact(['user']));
    }

    //https://rifaa.vercel.app/how-work

    public function transaction()
    {
        $user = Auth::user();

        if ($user) {
            $userbil = DB::table('orders')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->join('gop_orders', 'orders.id', '=', 'gop_orders.order_id')
                ->where('orders.user_id', '=', auth()->user()->id)
                ->get();

            //return $userbil;


            return view('frontend.user.transaction', compact('user', 'userbil'));
        } else {
            return redirect()->route('home')->with('Login first Please and Acive your account   ');
        }
    }
    //dashBoard
    public function personalInformation()
    {
        $user = Auth::user();

        if ($user) {
            $userbil = DB::table('orders')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->join('gop_orders', 'orders.id', '=', 'gop_orders.order_id')
                ->join('group_products', 'group_products.id', '=', 'gop_orders.gop_id')

                ->where('orders.user_id', '=', auth()->user()->id)->get();
            //return $userbil;




            //    $empidcheck= DB::table('emps')
            //    ->get();

            //return $empidcheck;
            return view('frontend.user.personalInformation', compact('user', 'result'));
        } else {
            return redirect()->route('home')->with('Login first Please and Acive your account   ');
        }
    }
    public function graph()
    {

        $user = Auth::user();
        return view('frontend.user.graph', compact('user'));
    }

    public function editpersonalInformation()
    {

        $user = Auth::user();
        return view('frontend.user.personaldata', compact('user'));
    }

    public function editpass()
    {

        $user = Auth::user();
        return view('frontend.user.editpass', compact('user'));
    }



    //dashBoard
    public function userlottery()
    {
        $user = Auth::user();
        return view('frontend.user.userlottery', compact('user'));
    }
    //dashBoard
    public function userreferral()
    {
        $user = Auth::user();
        if ($user) {
            $userref = user::withDepth()->descendantsOf($user->id)->toTree($user->id);
            //return $userref[0]['id'];
            //         SELECT *
            //   FROM orders
            //   INNER JOIN users
            //   ON orders.user_id = users.id
            //   WHERE orders.payment_status ='paid' AND users.id=3

            $userreftest = DB::table('orders')
                ->join('users', 'orders.user_id', 'users.id')
                ->where('orders.user_id', '=', $user->id)
                ->get();
            //return $userreftest;
            //  $tree = user::ancestorsAndSelf($user->id);
            //  $all = user::with('ancestors')->paginate(30);
            // in view for breadcrumbs:
            //return $all;
            return view('frontend.user.userreferral', compact(['user', 'userref', 'userreftest']));
        } else {
            return redirect()->route('home')->with('error', 'login first please');
        }
    }

    public function contact()
    {
        $user = Auth::user();
        return view('frontend.user.contact', compact('user'));
    }


    public function termsAndConditions()
    {

        return view('frontend.TermsAndConditions');
    }
    public function privacypolicy()
    {

        return view('frontend.privacypolicy');
    }



    //cartDetails
    public function cartDetails()
    {

        return view('frontend.user.cart');
    }




    public function artsDispaly($slug)
    {
        //$banners = Banner::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('15')->get();
        $setting = setting::orderBy('id', 'DESC')->limit('1')->get();
        $artsUrls = art::where('slug', $slug)->first();
        if ($artsUrls) {
            return view('frontend.pages.artDeyails', compact(['artsUrls', 'setting']));
        } else {
            return 'Art Not found ';
        }
    }
    //all arts
    public function arts()
    {
        $setting = setting::orderBy('id', 'DESC')->limit('1')->get();
        $arts = art::where(['status' => 'active'])->all();
        return view('frontend.pages.artDeyails', compact(['arts', 'setting']));
    }
    //sngilbranch
    public function sngilbranch($slug)
    {
        $setting = setting::orderBy('id', 'DESC')->limit('1')->get();
        $onebranch = Branch::where('slug', $slug)->first();
        if ($onebranch) {
            return view('frontend.pages.onebranch', compact(['onebranch', 'setting']));
        } else {
            return 'Art Not found ';
        }
    }


    //get all prouduct
    public function allproduct()
    {
        // dd ($slug);





        return view('frontend.pages.products', compact(['prod_index']));
    }

    //product without  one product

    public function product($slug)
    {
        //return $slug;


        //return[ $gop];
        return view('frontend.pages.product');
    }


    // GEt URl SLUG FILTER BY SLUG
    // public function groupOfProduct($slug)
    // {

    //     //dd($slug);
    //     $shareComponent = \Share::page(
    //         'https://SehaSave.com/',
    //         'Your share text comes here',
    //     )
    //         ->facebook()
    //         //->twitter()
    //         ->linkedin()
    //         //->telegram()
    //         ->whatsapp()
    //         //->reddit()
    //     ;


    //     //$product = prodcut::where('',$gop->id)->get();
    //     //return $gop;
    //     return view('frontend.pages.box', compact(['gop',  'shareComponent']));
    // }






    // GEt otp
    public function otp()
    {
        $user = Auth::user();

        return view('frontend.user.otp', compact('user'));
    }

    public function about()
    {

        $banners = Banner::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('5')->get();
        $client = client::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('10')->get();
        $testim = testim::where(['status' => 'active'])->orderBy('id', 'DESC')->get();
        $team = team::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('10')->get();
        $abouts = about::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('1')->get();
        $arts = art::where(['status' => 'active'])->orderBy('id', 'DESC')->limit(3)->get();

        $featuredDoctors = User::with(['doctorProfile', 'schedules'])
            ->where('role', 'doctor')
            ->where('status', 'active')
            ->whereHas('doctorProfile', function ($query) {
                $query->where('is_featured', true)
                    ->where('is_verified', true)
                    ->where('accepting_new_patients', true);
            })
            ->withCount(['doctorAppointments as total_appointments'])
            ->join('doctor_profiles', 'users.id', '=', 'doctor_profiles.doctor_id')
            ->orderByDesc('doctor_profiles.average_rating')
            ->select('users.*') // تأكد من تحديد أعمدة users فقط
            ->limit(10)
            ->get();

        $faqs = faq::where(['status' => 'active'])->orderBy('id', 'DESC')->limit(5)->get();

        $setting = setting::orderBy('id', 'DESC')->limit('1')->get();

        return view('frontend.about', compact(['banners', 'client', 'testim', 'team', 'setting', 'abouts', 'arts', 'featuredDoctors', 'faqs']));
    }



    //affiliate
    public function affiliate()
    {


        $banners = Banner::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('5')->get();
        $client = client::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('10')->get();
        $testim = testim::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('10')->get();
        $team = team::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('10')->get();
        $setting = setting::orderBy('id', 'DESC')->limit('1')->get();

        return view('frontend.affiliate', compact(['banners', 'client', 'testim', 'team', 'setting']));
    }

    public function Branchs()
    {
        $banners = Banner::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('15')->get();
        $client = client::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('10')->get();
        $branch = Branch::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('10')->get();

        return view('frontend.Branchs', compact(['banners', 'client', 'branch']));
    }



    //howwork
    public function howwork()
    {
        $banners = Banner::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('15')->get();
        $client = client::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('10')->get();

        return view('frontend.howitwork', compact(['banners', 'client']));
    }



    public function Category()
    {
        $banners = Banner::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('15')->get();
        $client = client::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('10')->get();

        return view('frontend.Category', compact(['banners', 'client']));
    }
    public function allservices()
    {
        $banners = Banner::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('15')->get();
        $client = client::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('10')->get();
        return view('frontend.services', compact(['banners', 'client']));
    }
    public function blogs()
    {
        $banners = Banner::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('15')->get();
        $client = client::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('10')->get();
        $arts = art::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('8')->get();
        $lastarts = art::where(['status' => 'active'])->orderBy('id', 'DESC')->get();
        //return $arts;
        return view('frontend.blogs', compact(['banners', 'client', 'arts', 'lastarts']));
    }

    public function media()
    {
        $banners = Banner::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('15')->get();
        $client = client::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('10')->get();

        return view('frontend.media', compact(['banners', 'client']));
    }

    public function Gallery()
    {
        $banners = Banner::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('15')->get();
        $client = client::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('10')->get();
        return view('frontend.Gallery', compact(['banners', 'client']));
    }



    public function faqs()
    {

        $faqs = faq::where(['status' => 'active'])->orderBy('id', 'DESC')->get();

        return view('frontend.faqs', compact(['faqs']));
    }


    public function Orientonline()
    {

        $faqs = faq::where(['status' => 'active'])->orderBy('id', 'DESC')->get();

        return view('frontend.orientonline', compact(['faqs']));
    }



    public function contactus()
    {


        $setting = setting::orderBy('id', 'DESC')->limit('1')->get();
        $client = client::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('10')->get();
        $banners = Banner::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('15')->get();
        return view('frontend.contactus', compact(['banners', 'client', 'setting']));
    }


    public function loginsignup()
    {

        return view('frontend.loginsignup');
    }






    public function subscribe(Request $request)
    {
        // التحقق من البيانات
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletter_subscribers,email'
        ], [
            'email.required' => __('newsletter.email_required'),
            'email.email' => __('newsletter.email_valid'),
            'email.unique' => __('newsletter.email_already_subscribed')
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // حفظ المشترك
            NewsletterSubscriber::create([
                'email' => $request->email,
                'status' => 'active',
                'subscribed_at' => now(),
                'locale' => app()->getLocale()
            ]);

            // رسالة نجاح حسب اللغة
            $message = app()->getLocale() == 'ar'
                ? 'تم الاشتراك بنجاح في النشرة البريدية!'
                : 'Successfully subscribed to newsletter!';

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', __('newsletter.subscription_failed'));
        }
    }

    /**
     * إلغاء الاشتراك
     */
    public function unsubscribe($email)
    {
        try {
            $subscriber = NewsletterSubscriber::where('email', $email)->first();

            if ($subscriber) {
                $subscriber->update(['status' => 'unsubscribed']);
                return view('frontend.newsletter.unsubscribe-success');
            }

            return view('frontend.newsletter.unsubscribe-error');
        } catch (\Exception $e) {
            return view('frontend.newsletter.unsubscribe-error');
        }
    }

    /**
     * عرض صفحة إدارة الاشتراك
     */
    public function manageSubscription()
    {
        return view('frontend.newsletter.manage-subscription');
    }
}
