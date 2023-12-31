<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Ui\Presets\Vue;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = auth()->user()->unreadNotifications;
        return View('Admin.layouts.index' , compact('notifications'))->with(
            [
                'popularCat' => $this->getMostPopularCat(),
                'popularRegion' => $this->getMostPopularRegion(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMostPopularCat()
    {
        $cat = DB::select(' select c.name, count(p.categoryId) as count
        FROM  categoris c, places p
        WHERE c.id = p.categoryId
        GROUP BY c.name 
        ORDER BY count(p.categoryId) DESC limit 5 ');

        return $cat;
    }

    public function getMostPopularRegion()
    {
        $region = DB::select(' select  r.name as region, count(u.regionId) as value
        FROM  regions r , users u
        WHERE r.id = u.regionId
        GROUP BY r.name  limit 6');

        return $region;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'email' => 'required|string|exists:App\Models\User',
            'password' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        if( $account = User::where('email' , $request->email)->first()){
            if($account->userType == 'admin'){
                Auth::login($account);
                return redirect()->route('admin')->with('success','You are Logged in sucessfully.');
            }
            else{
                return back()->with('error','you are not "Admin"');
            }
        }else {
            return back()->with('error','Whoops! invalid information');
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
