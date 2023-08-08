<?php

namespace App\Http\Controllers;

use App\Events\placeCreated;
use App\Models\Places;
use App\Http\Requests\StorePlacesRequest;
use App\Http\Requests\UpdatePlacesRequest;
use App\Mail\email_To_Place;
use App\Models\Region;
use App\Models\User;
use App\Traits\GenralTraits;
use App\Traits\ImageTraits;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

    public function create()
    {
        $notifications = auth()->user()->unreadNotifications;
        return view('Admin.places.create' ,  compact('notifications'));
    }

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
        $places = User::where('id' , 12)->first();
        $places->password = Hash::make('11223344');

        return  $places->update();


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

        $places = Places::where('categoryId' , $request->catId)->orWhere('subCategoryId' , $request->catId)->orderBy('rate' , 'desc')->get();
        
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
        $place->isAccepted = true;
        $place->update();
        // dd( $place);
        auth()->user()
        ->unreadNotifications
        ->when($id, function ($query) use ($id) {
            return $query->where('id', $id);
        })
        ->markAsRead();
        //send Email
        $msg = [
            'massage' =>  "تم قبول تسجيلك في تطبيقنا ،الأن يمكنك التمتع بكافة الخدمات"
        ];
        Mail::to($place->account->email)->send(new email_To_Place($msg));

        return redirect()->back();
    }


    public function rejected_place($id) {
        $place = Places::find($id);
        $place->isAccepted = false;
        $place->update();
        auth()->user()
        ->unreadNotifications
        ->when($id, function ($query) use ($id) {
            return $query->where('id', $id);
        })
        ->markAsRead();
        //send email
        $msg = [
            'massage' =>   'تم رفض تسجيلك في تطبيقنا ، الرجاء محاولة التسجيل مرة أخرى مع إدخال بيانات صحيحية' ,
        ];
        Mail::to($place->account->email)->send(new email_To_Place($msg));
        //delete account
        $account = User::find($place->accountId)->delete();
        return redirect()->back();
    }

    public function searchByPlaceName(Request $request){
        $validation = Validator::make($request->all() , [
            'word' => 'required|string'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $places = Places::where('placeName','LIKE' ,"%{$request->word}%")
        ->orWhere('placeName','LIKE' ,"%{$request->word}")
        ->orWhere('placeName','LIKE' ,"{$request->word}%")->get();

        return $this->returnData('places' , $places);
    }

    public function searchPlaceByCategory(Request $request){
        $validation = Validator::make($request->all() , [
            'catId' => 'required|int',
            'word' => 'required|string'
        ]);

        if($validation->fails()){
            return response()->json($validation->errors());
        }

        $places = Places::where(['categoryId'=>$request->catId] , ['isParent' => null])->Where(function (Builder $query) use ($request){
            $query->where('placeName','LIKE' ,"%{$request->word}%")
            ->orWhere('placeName','LIKE' ,"%{$request->word}")
            ->orWhere('placeName','LIKE' ,"{$request->word}%");
        })->get();

        return $this->returnData('places' , $places );
    }

    public function filter(Request $request) {
        $validation = Validator::make($request->all() , [
            'category' => 'present|array',
            'region' => 'present|array',
        ]);
        
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        
        if (count($request->region) != 0 ) {
            $places = Places::with('account')->whereHas('account' , function ($q) use ($request) {
                $q->whereIn('regionId' , $request->region);
            })->orderBy('rate' , 'desc');

        } else {
            $places = Places::orderBy('rate' , 'desc');
        }
        
        if (count($request->category) != 0 ) {
            $places = $places->whereIn('subCategoryId' , $request->category)->get();
        } else{
            $places = $places->get();
        }

        if ($places) {
            return $this->returnData('places' ,  $places  , 'success');
        }else{
            return $this->returnData('places' ,  $places  , 'NO items matching');
        }
    }

    public function filterPlaceName(Request $request){
        $validation = Validator::make($request->all() , [
            'name' => 'required|string'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }
        $places = Places::where('placeName',$request->name)->first();

        if ($places) {
            return $this->returnData('places' ,  $places  , 'success');
        }else{
            return response()->json(['status' => 400 , 'msg'  => 'There is no place like this name' , 'place'  => $places ]);
        }
    }


    public function getMaxRatingPlace() {
        $place = Places::where('rate' , '>' , 3)->orderBy('rate' , 'desc')->get();

        return $this->returnData('place' , $place , 'Success');
    }
}
