<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Places;
use App\Models\Service;
use App\Models\User;
use App\Traits\GenralTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    use GenralTraits;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('subscriber.pages.info');
    }

    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'email' => 'required|string|unique:users|email',
            'password' => 'required|string|min:8',
            'fullName' => 'required|string',
            'deviceId' => 'required|string|max:255',
            'userType' => 'required|in:admin,user,subscriber',
            'gender' => 'required|in:male,fmale',
            'phone' => 'required|numeric|unique:users|starts_with:09,+963,00963',
            'regionId' => 'nullable|integer' ,
            'streetId' => 'nullable|integer',
        ]);


        if($validator->fails()){
                return response()->json($validator->errors(), 400);
        }
        
        $accout = User::create([
            'email' => $request->email,
            'fullName' => $request->fullName,
            'password' => Hash::make($request->password),
            'deviceId' => $request->deviceId,
            'userType' => $request->userType,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'regionId'=> $request->regionId ,
            'streetId' => $request->streetId,

        ]);

        $token = $accout->createToken($request->deviceId)->plainTextToken;
        $accout->remember_token = $token;
        $accout->save();
        $accout['token'] = $token;
        return ['accout' => $accout];
    }

    
    public function login(Request $request)
    {
        
        $validator = Validator::make($request->all() , [
            'email' => 'required|string|exists:App\Models\User',
            'password' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $account = User::where('email' , $request->email)->first();
        if( $account && Hash::check($request->password , $account->password)){
            $token =  $account->createToken($account->deviceId)->plainTextToken;
            $account['remember_token'] = $token;
            $account->update();
            return ['account' => $account , 'token' => $token];
        }else{
            return response()->json(["msg" => 'Data is invalid'], 400);
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete()->where('name' , $request->deviceId);

        // // return  $request->token;
            // $account = Auth::user();
            // // return $account;
            // $personalToken = PersonalAccessToken::findToken($request->token);
            // // return $personalToken;
            // if ($account->id == $personalToken->tokenable_id &&
            //     get_class($account) == $personalToken->tokenable_type) {
            //     $personalToken->delete();
        // }
    }
}
