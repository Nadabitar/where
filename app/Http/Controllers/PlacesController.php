<?php

namespace App\Http\Controllers;

use App\Events\placeCreated;
use App\Models\Places;
use App\Http\Requests\StorePlacesRequest;
use App\Http\Requests\UpdatePlacesRequest;
use App\Models\Region;
use App\Models\User;
use App\Traits\GenralTraits;
use App\Traits\ImageTraits;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PlacesController extends Controller
{
    use GenralTraits , ImageTraits;
    
    public function index(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'id' => 'string|required',
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }

        $place = Places::where('id' , $request->id)->first();

        return $this->returnData('place' , $place , 'Success');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notifications = auth()->user()->unreadNotifications;
        return view('Admin.places.create' ,  compact('notifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlacesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlacesRequest $request)
    {

        $request->validated();
        $place = new Places();
        $place->accountId = Auth::user()->id;
        $workTime = sprintf('Open From %s To %s' , $request->from , $request->to);
        $place->categoryId  = $request->categoryId;
        $place->subCategoryId  = $request->subCategoryId;
        $place->placeName = $request->placeName;
        $place->phone = $request->phoneNumber ;
        $place->details = $request->details;
        $place->workTime = $workTime;
        $place->links = $this->socialkMedia($request);

        $place->image = $request->hasFile('image')? $this->uploadImage($request->file('image')->getRealPath()): $this->returnError(201 , 'image is required') ;
        $result = $place->save();
        if($result){

            event(new placeCreated($place));
            return redirect()->route('subscriber.dashboard')->with([
                'message' => 'Product Added successfully',
                'alert-type' => 'success'
            ]);
        }else{
            return back()->with(['error' => 'something went error']);
        }
    }

    public function show(Places $places)
    {
        $places = Places::latest()->get();
        $notifications = auth()->user()->unreadNotifications;
        return view('Admin.places.index' , compact('places' , 'notifications'));
    }

    public function edit(Places $places)
    {
        //
    }

    public function update(UpdatePlacesRequest $request, Places $places)
    {
        
    }

    public function destroy(Places $places)
    {
        //
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


    public function getPlaceByCat(Request $request)
    {
        $validation = Validator::make($request->all() , [
            'catId' => 'required'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }

        $places = Places::where('categoryId' , $request->catId)->orWhere('subCategoryId' , $request->catId)->get();
        
        if ($places) {
            return $this->returnData('places' ,$places);
        }else{
            return $this->returnError('400' , "Something went error");
        }

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

    public function new_registered_places() {
        $notifications = auth()->user()->unreadNotifications;
        return view('Admin.places.newPlaces' , compact('notifications'));
    }

    public function accepted_place($placeId ,$id) {
        $place = Places::find($placeId);
        $place ->isAccepted = true;
        auth()->user()
        ->unreadNotifications
        ->when($id, function ($query) use ($id) {
            return $query->where('id', $id);
        })
        ->markAsRead();
        return redirect()->back();
    }

    public function rejected_place($id) {
        $place = Places::find($id);
        $place ->isAccepted = false;
        auth()->user()
        ->unreadNotifications
        ->when($id, function ($query) use ($id) {
            return $query->where('id', $id);
        })
        ->markAsRead();
        return redirect()->back();
    }
}
