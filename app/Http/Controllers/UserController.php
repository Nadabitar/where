<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountsRequest;
use App\Models\User;
use App\Traits\GenralTraits;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller  
{   
    use GenralTraits;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('userType' , 'user')->latest()->get();
        return View('Admin.users.index')->with('users' , $users);
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
     * @param  \App\Models\tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountsRequest $request )
    {
        $request->validate();
        $user = User::find(Auth::user()->id);

        $user->email = $request->email;
        $user->fullName = $request->fullName;
        // $user->password = Hash::make($request->password);
        // $user->deviceId = $request->deviceId;
        // $user->userType = $request->userType;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->regionId = $request->regionId ;
        $user->streetId = $request->streetId;

        $result = $user->update();

        if ($result) {
            return  $this->returnSuccessMessage("updated successfully");
        }else{
            return  $this->returnError('400',"Something went error");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
