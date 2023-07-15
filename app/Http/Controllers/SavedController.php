<?php

namespace App\Http\Controllers;

use App\Models\saved;
use App\Models\User;
use App\Traits\GenralTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SavedController extends Controller
{
    use GenralTraits;
    public function index()
    {
        $user = User::where('id' , Auth::user()->id)->with('isSaved' , 'savedService')->first();

        // foreach ($user->isSaved as $item) {
        //     $item['region'] = User::where('id' ,$item->accountId)->first()->region->name;
        //     $item['street'] = User::where('id' ,$item->accountId)->first()->street->name;
        // }
        
        $data = [
            'places' =>  $user->isSaved ,
            'services' =>  $user->savedService ,
        ];
        if ($user) {
            return $this->returnData('saved' ,  $data );
        }else{
            return $this->returnError('saved' ,  $data  , 'there is no saveds');
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'placeId' => 'required|sometimes',
            'serviceId' => 'required|sometimes'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        if ($request->serviceId) {
            $user = User::where('id' , Auth::user()->id)->first();
            $result = $user->isSaved()->attach($request->placeId);
        }

        if ($result) {
            return  $this->returnSuccessMessage("Saved successfully");
        }else{
            return  $this->returnError('400',"Something went error");
        }

    }

    public function show(saved $saved)
    {
        //
    }

    public function edit(saved $saved)
    {
        //
    }

    public function update(Request $request, saved $saved)
    {
        //
    }

    public function destroy(saved $saved)
    {
        //
    }

    public function userIsSeved(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'placeId' => 'required'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
       $placeId = $request->placeId;
        $user = DB::select('select * from saveds  
        where 
        userId = ? 
        and placeId = ?
        ' , [Auth::user()->id , $placeId]);
        
       
        if ($user) {
            return $this->returnSuccessMessage('founded' , 200 );
        }else{
            return $this->returnError('400' , "Not saved");
        }
    }
}
