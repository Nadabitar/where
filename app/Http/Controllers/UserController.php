<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountsRequest;
use App\Models\Places;
use App\Models\User;
use App\Traits\GenralTraits;
use App\Traits\ImageTraits;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller  
{   
    use GenralTraits , ImageTraits;

    public function place()
    {
        return Places::where('accountId' , Auth::user()->id)->first();
    }
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

    public function updateImage(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $place =$this->place();
        $place->image = $request->hasFile('image')? $this->uploadImage($request->file('image')->getRealPath()): $this->returnError(201 , 'image is required') ;
        $result = $place->update();
        if($result){
            return redirect()->route('Profile.show')->with([
                'message' => 'Image Updated successfully',
                'alert-type' => 'success'
            ]);
        }else{
            return redirect()->back()->with(['errors' => 'something went error']);
        }
    }

    public function updatePlaceName(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'placeName' => 'required|string' ,
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $place =$this->place();
        $place->placeName = $request->placeName ;
        $result = $place->update();
        if($result){
            return redirect()->route('Profile.show')->with([
                'message' => 'Place Name updated successfully',
                'alert-type' => 'success'
            ]);
        }else{
            return back()->with(['error' => 'something went error']);
        }
    }

    public function show()
    {
        $locations = [
            ["lat" => 36.2021, "lng" => 37.1343],
          ];
        $place = Places::where('accountId' , Auth::user()->id )->first();
        return view('subscriber.pages.profile' , compact('place' , 'locations'));
    }

    public function updatePhoneNumber(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'phoneNumber' => 'required|string' ,
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $place =$this->place();
        $place->phone = $request->phoneNumber ;
        $result = $place->update();
        if($result){
            return redirect()->route('Profile.show')->with([
                'message' => 'Phone Number updated successfully',
                'alert-type' => 'success'
            ]);
        }else{
            return back()->with(['error' => 'something went error']);
        }
    }

    public function updateDetails(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'details' => 'required|string' ,
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $place =$this->place();
        $place->details = $request->details ;
        $result = $place->update();
        if($result){
            return redirect()->route('Profile.show')->with([
                'message' => 'Details updated successfully',
                'alert-type' => 'success'
            ]);
        }else{
            return back()->with(['error' => 'something went error']);
        }
    }

    public function update(UpdateAccountsRequest $request )
    {
        $user = User::find(Auth::user()->id);

        $user->fullName = $request->fullName;
        $user->regionId = $request->regionId ;
        $user->streetId = $request->streetId;
        $user->gender = $request->gender;

        $result = $user->update();

        if ($result) {
            return  $this->returnSuccessMessage("updated successfully");
        }else{
            return  $this->returnError('400',"Something went error");
        }

    }

    public function updateWorkTime(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'from' => 'required|string',
            'to' => 'required|string',
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $place =$this->place();
        $place->workTime =  sprintf('Open From %s To %s' , $request->from , $request->to) ;
        $result = $place->update();
        if($result){
            return redirect()->route('Profile.show')->with([
                'message' => 'Work Time updated successfully',
                'alert-type' => 'success'
            ]);
        }else{
            return back()->with(['error' => 'something went error']);
        }
    }



    public function updateLinks(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'facebook' => 'required|string',
            'whats' => 'required|string',
            'instagram' => 'required|string',
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $place =$this->place();
        $place->links = $this->socialkMedia($request);
        $result = $place->update();
        if($result){
            return redirect()->route('Profile.show')->with([
                'message' => 'Social Media Links updated successfully',
                'alert-type' => 'success'
            ]);
        }else{
            return back()->with(['error' => 'something went error']);
        }
    }

    public function socialkMedia(Request $request)
    {
        $links = [
            'facebook' => $request->facebook ? $request->facebook : 'Null',
            'whats' => $request->whats ? $request->whats : 'Null',
            'instagram' => $request->instagram ? $request->instagram : 'Null',
        ];
        return $links;
    }

    public function updateCategory(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'categoryId' => 'required' ,
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $place =$this->place();
        $place->categoryId = $request->categoryId;
        $result = $place->update();
        if($result){
            return redirect()->route('Profile.show')->with([
                'message' => 'Category Id updated successfully',
                'alert-type' => 'success'
            ]);
        }else{
            return back()->with(['error' => 'something went error']);
        }
    }

    public function updateSubCategor(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'subCategoryId'=> 'required' ,
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $place =$this->place();
        $place->subCategoryId = $request->subCategoryId;
        $result = $place->update();
        if($result){
            return redirect()->route('Profile.show')->with([
                'message' => 'sub Category Id updated successfully',
                'alert-type' => 'success'
            ]);
        }else{
            return back()->with(['error' => 'something went error']);
        }
    }


    public function addLocation(Request $request){
        $validation = Validator::make($request->all() , [
            'lat'=> 'required' ,
            'lng'=> 'required' ,
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $place =$this->place();
        $place->latitud  = $request->lat;
        $place->longitude = $request->lng;

        $result = $place->update();

        if($result){
            return redirect()->route('Profile.show')->with([
                'message' => 'Location Added successfully',
                'alert-type' => 'success'
            ]);
        }else{
            return back()->with(['error' => 'something went error']);
        }

    }


}
