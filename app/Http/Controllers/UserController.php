<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountsRequest;
use App\Models\Places;
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
            return redirect()->route('subscriber.pages.profile')->with([
                'message' => 'Image Updated successfully',
                'alert-type' => 'success'
            ]);
        }else{
            return back()->with(['error' => 'something went error']);
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
            return redirect()->route('subscriber.pages.profile')->with([
                'message' => 'Place Name updated successfully',
                'alert-type' => 'success'
            ]);
        }else{
            return back()->with(['error' => 'something went error']);
        }
    }

    public function show()
    {
        $place = Places::where('accountId' , Auth::user()->id )->first();
        return view('subscriber.pages.profile' , compact('place'));
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
            return redirect()->route('subscriber.pages.profile')->with([
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
            return redirect()->route('subscriber.pages.profile')->with([
                'message' => 'Details updated successfully',
                'alert-type' => 'success'
            ]);
        }else{
            return back()->with(['error' => 'something went error']);
        }
    }

    public function update(UpdateAccountsRequest $request )
    {
        $request->validate();
        $user = User::find(Auth::user()->id);

        $user->fullName = $request->fullName;
        $user->regionId = $request->regionId ;
        $user->streetId = $request->streetId;

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
            return redirect()->route('subscriber.pages.profile')->with([
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
            return redirect()->route('subscriber.pages.profile')->with([
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
            return redirect()->route('subscriber.pages.profile')->with([
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
            return redirect()->route('subscriber.pages.profile')->with([
                'message' => 'sub Category Id updated successfully',
                'alert-type' => 'success'
            ]);
        }else{
            return back()->with(['error' => 'something went error']);
        }
    }


}
