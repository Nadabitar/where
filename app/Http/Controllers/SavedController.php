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
        // $user = User::where('id' , Auth::user()->id)->with('isSaved' , 'savedService')->first();
        $places = DB::select(' select places.placeName , places.details , places.image , places.rate  ,saveds.* 
        from places join  saveds
        on  places.id = saveds.placeId 
        where saveds.userId = ?' , [ Auth::user()->id]);

        $services = DB::select('  select saveds.id as id , saveds.serviceId ,saveds.userId, services.placeId , services.content , services.title , galleries.url as url
        from services join  saveds
        on  services.id = saveds.serviceId
        JOIN galleries 
        ON services.id = galleries.serviceId
        where saveds.userId = ?' , [ Auth::user()->id]);
        
        $data = [
            'places' => $places ,
            'services' =>  $services ,
        ];
        return $this->returnData('saved' ,  $data );
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'placeId' => 'required|sometimes|int',
            'serviceId' => 'required|sometimes|int'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $user = User::where('id' , Auth::user()->id)->first();
        if ($request->placeId) {
            $result = $user->isSaved()->attach($request->placeId);
        }else if($request->serviceId){
            $result = $user->savedService()->attach($request->serviceId);
        }else{
            return  $this->returnError('400',"you need to pass Place Id or Service Id");
        }

        if (!$result) {
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

    public function destroy(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'placeId' => 'sometimes|int',
            'serviceId' => 'sometimes|int'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $user = User::where('id' , Auth::user()->id)->first();

        if ($request->placeId) {
            $result = $user->isSaved()->detach($request->placeId);
        }else if($request->serviceId){
            $result = $user->savedService()->detach($request->serviceId);
        }

        if ($result) {
            return  $this->returnSuccessMessage("unSaved successfully");
        }else{
            return  $this->returnError('400',"Something went error");
        }
    }

    public function userIsSeved(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'placeId' => 'required|int'
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
    public function userServiceIsSaved(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'serviceId' => 'required|int'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $serviceId = $request->serviceId;
        $user = DB::select('select * from saveds  
        where 
        userId = ? 
        and serviceId = ?
        ' , [Auth::user()->id , $serviceId]);
        if ($user) {
            return $this->returnSuccessMessage('founded' , 200 );
        }else{
            return $this->returnError('400' , "Not saved");
        }
    }
}
