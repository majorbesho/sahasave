<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\EmailVerification;
use Mail;
use App\Models\networks;
use Illuminate\Support\Str;
use App\Models\product;
use App\Models\Projects;
use App\Models\setting;
use App\Jobs\SendResetEmail;


class APIController extends Controller
{
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function login(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'failed', 'message' => $validator->errors()->first()], 422);
        }
        //logger()->debug( $params);
        try {
            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
                'status' => 'active',
            ])) {
                $user =  $this->userModel->where('email', $request->email)->first();

                if (array_key_exists("onesignal_device_id", $params)) {
                    if (!empty($params['onesignal_device_id']) && $params['onesignal_device_id'] != "null") :
                        $user->update(['onesignal_device_id' => str_replace('"', '', $params['onesignal_device_id'])]);
                    endif;
                }

                return response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'user' => new UserResource($user),
                    'access_token' => $user->createToken('accessToken')->plainTextToken
                ], 200);
            } else {
                return response()->json(["message" => "invalid login"], 401);
            }
        } catch (\Throwable $th) {
            logger()->debug($th->getMessage());
            return response()->json(["message" => "invalid login"], 401);
        }
    }


    public function registerSubmit(Request $request)
    {

        //return $request->all();
        $validator = Validator::make($request->all(), [
            'email' => 'email|required|max:255|unique:users',
            'password' => 'required|min:4',
            'name' => 'nullable|string',
            'nationality' => 'required',
            'dateOfbarth' => 'required',
            'phone' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'failed', 'message' => $validator->errors()->first()], 422);
        }
        $referral_code = Str::random(10);
        $remember_token = Str::random(60);
        //return $request->all();
        if (!empty($request->referral_code)) {
            //return $request->all()
            /*
           user has ref (userData)
           get user data
           search for level in network


           */
            $level1 = "";

            // add the levels of ref
            $userData = User::where('referral_code', $request->referral_code)->get();
            $usernetwork =  networks::with('user')
                ->where('parent_user_id', [$userData[0]['id']])
                ->get();
            return $usernetwork;
            return $usernetwork;
            if (count($usernetwork) >= 0 && count($usernetwork) < 1) {
                $level1 = 1;
            } else if (count($usernetwork) >= 1 && count($usernetwork) < 2) {
                $level1 = 2;
            } else if (count($usernetwork) >= 2 && count($usernetwork) < 3) {
                $level1 = 3;
            } else if (count($usernetwork) >= 3 && count($usernetwork) < 4) {
                $level1 = 4;
            } else if (count($usernetwork) >= 4 && count($usernetwork) < 5) {
                $level1 = 5;
            }



            $levelinnetwork1 = networks::with('user')
                // ->whereNotNull('level1')
                ->where('referral_code', $request->referral_code)
                ->get();
            return $levelinnetwork1;
            $levelinnetwork2 = networks::with('user')->whereNotNull('level2')->get();

            $levelinnetwork3 = networks::with('user')->whereNotNull('level3')->get();
            $levelinnetwork4 = networks::with('user')->whereNotNull('level4')->get();
            $levelinnetwork5 = networks::with('user')->whereNotNull('level5')->get();




            //return $userData;
            if (count($userData) > 0) {
                //return $userData;



                $userId  = user::insertGetId([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'name' => $request->name,
                    'nationality' => $request->nationality,
                    'dateOfbarth' => $request->dateOfbarth,
                    'phone' => $request->phone,
                    'referral_code' => $referral_code,
                    'remember_token' => $remember_token
                ]);

                networks::create([
                    'referral_code' => $request->referral_code,
                    'user_id' => $userId,
                    'parent_user_id' => $userData[0]['id'],
                    'level1' => $request->referral_code,
                ]);



                $data = $request->all();
                $userid = User::orderBy('id', 'DESC')->first();
                //Session::put('user', $data['email']);

                //Auth::login($userid);

                if ($userId) {
                    return response()->json([
                        'status' => true,
                        'message' => 'User Registration Successfully',
                        'user' => new UserResource($userid),
                        'access_token' => $userid->createToken('accessToken')->plainTextToken
                    ], 200);
                } else {
                    return response()->json(["message" => "something went wrong"], 400);
                }
            } else {
                return response()->json(["message" => "invalid registration"], 400);
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
                'remember_token' => $remember_token
            ]);



            $userid = User::orderBy('id', 'DESC')->first();


            if ($userId) {
                return response()->json([
                    'status' => true,
                    'message' => 'User Registration Successfully',
                    'user' => new UserResource($userid),
                    'access_token' => $userid->createToken('accessToken')->plainTextToken
                ], 200);
            } else {
                return response()->json(["message" => "invalid registration"], 400);
            }
        }
    }


    public function resetRequest(Request $request)
    {
        $param = $request->all();

        $validator = Validator::make($param, [
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'failed', 'message' => $validator->errors()->first(), 'Validation Error'], 422);
        }
        $condition = [
            ["email", strtolower($param['email'])],
            ["status", '!=', "blocked"],
            ["status", '!=', "deleted"],
        ];


        $result = $this->userModel->where($condition)->first();
        //logger()->info($result);
        if ($result) {

            SendResetEmail::dispatchNow($result);
            logger()->debug("password reset email sent > " . $result->email);
            return response()->json([
                'status' => 'success',
                'message' => 'Password reset email sent to your inbox'
            ], 200);
        } else {
            logger()->debug("email not found");
            return response()->json([
                'status' => 'failed',
                'message' => 'Invalid email address'
            ], 422);
        }
    }
    public function updateAccount(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'id' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => "failed", 'message'  => "invalid operation"], 422);
        }

        $result = $this->userModel->find($params["id"]);

        if ($result && $result->update(["status" => $params["status"]])) {
            $response = ['status' => 'success', 'message' => 'successful'];
            return response()->json($response, 200);
        } else {
            return response()->json(['status' => "failed", 'message'  => "invalid operation"], 422);
        }
    }
    public function logOut(Request $request)
    {

        auth()->logout();
        $response = ['status' => 'success', 'message' => 'You have been successfully logged out!'];
        return response()->json($response, 200);
    }
}
