<?php

namespace App\Http\Controllers;

use App\Mail\SendCodeMail;
use App\Models\Comment;
use App\Models\Places;
use App\Models\Service;
use App\Models\User;
use App\Traits\GenralTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\returnSelf;

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
        $result = Auth::user()->tokens()->where('name' , $request->deviceId)->delete();

        if ($result) {
            return $this->returnSuccessMessage('logout successfully');
        }else {
            return $this->returnError( '400','Something went error');
        }
    }

    public function changePassword()
    {
        $c = rand(100000, 500000);
        $code = [
            'yourCode' =>   $c ,
        ];
        Mail::to(Auth::user()->email)->send(new SendCodeMail($code));

        return $this->returnData('code' ,   $c  , 'Check your Email');
    }
    public function updatePassword(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'newPassword' => 'required'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }

        $user = User::where('id' , Auth::user()->id)->first();

        $user->password = Hash::make($request->newPassword);

        $result = $user->update();
        
        if ($result) {
            return $this->returnSuccessMessage('updated password successfully');
        }else {
            return $this->returnError( '400','Something went error');
        }
    }
}
