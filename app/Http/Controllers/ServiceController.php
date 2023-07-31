<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Models\Gallery;
use App\Models\Places;
use App\Models\Service;
use App\Traits\GenralTraits;
use App\Traits\ImageTraits;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    use GenralTraits;
    use ImageTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $place = Places::where('accountId' , Auth::user()->id)->first();
        $services = Service::where('placeId' , $place->id)->has('gallery')->latest()->get();
        // dd($services[0]->gallery);
        return View('subscriber.pages.Service.service' ,  compact('place' , 'services'));
    }

    public function create()
    {
        //
    }

    public function store(ServiceStoreRequest $request , $id)
    {
        // dd($request);
        $request->validated();
        // Create
        $service = new Service();
        $service->placeId = $id ;
        $service->content = $request->content;
        $service->title =  $request->title;
        $service->save();
        
        if($result = $this->getUrlImage($service , $request)){
            return redirect()->route('subscriber.dashboard')->with([
                'message' => 'Service Added successfully',
                'alert-type' => 'success'
            ]);
        }else{
            return back()->with(['error' => 'Something went error']);
        }
    }

    public function show(Service $service)
    {
        // dd(Auth::user()->id);
        $place = Places::where('accountId' , Auth::user()->id)->first();
        $services = Service::has('gallery')->where('placeId' , $place->id)->latest()->paginate(4);
        return View('subscriber.pages.Service.create' , compact('place' , 'services'));
    }

    public function edit(Service $service , $id)
    {
        $service = Service::with('gallery')->where('id' , $id)->get()[0];
        $place = Places::where('accountId' , Auth::user()->id)->first();
        return View('subscriber.pages.Service.update' ,  compact('service' , 'place'));
    }

    public function update(ServiceUpdateRequest $request,$id)
    {
        $request->validated();
        $service = Service::find($id);
        // dd(  $service);
        $service->placeId =$service->place->id ;
        $service->content = $request->content;
        $service->title =  $request->title;
        $service->save();
        
        if($result = $this->updateUrlImage($service , $request)){
            // dd($result);
            return redirect()->route('Service.all')->with([
                'message' => 'Service Added successfully',
                'alert-type' => 'success'
            ]);
        }else{
            // dd($result);
            return back()->with(['errors' => 'Something went error']);
        }
    }
    
    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();
        return redirect()->back()->with('success' , 'Deleted Successfuly');
    }

    public function getUrlImage(Service $service , Request $request)
    {
        $result = null;

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as  $img) {
                $gallary = new Gallery();
                $gallary->url = $this->uploadImage($img->getRealPath());
                $result = $service->gallery()->save($gallary);
            }
        }else{
            $this->returnError(201 , 'image is required') ;
        }

        return $result;
    }

    public function updateUrlImage(Service $service , Request $request)
    {
        $image = $request->hasFile('image')? $this->uploadImage($request->file('image')->getRealPath()): $this->returnError(201 , 'image is required') ;
        $gallary = Gallery::where('serviceId' , $request->id)->first();
        // dd($gallary);
        $gallary->url = $image;

        $result = $service->gallery()->save($gallary);

        return $result;
    }



    public function getServices(Request $request)
    {
        
        $validation = Validator::make($request->all() , [
            'placeId' => 'string|required',
        ]);
        if($validation->fails()){
            return response()->json($validation->errors());
        }


        $services = Service::with('gallery' , 'place'  )->where('placeId' , $request->placeId)->get();
        foreach ($services as $service) {
            $service['saved'] = DB::select('select * from saveds  
            where 
            userId = ? 
            and serviceId = ? ' , [Auth::user()->id , $service->id]) ? true : false ;
        }

        return $this->returnData('services' , $services  , 'success');

    }


    public function newService(Request $request){
        $services = Service::where('placeId' , $request->id)->latest()->limit(6)->get();
        foreach ($services as $item) {
            $item['image'] =  $item->gallery[0]->url;
            $item['savedCount'] = count( $item->isSaved);

        }
        return $this->returnData('services' , $services );
    }


    public function unActiveService(Request $request){
        $services = Service::where('placeId' , $request->id)->Where('status' , 0)->orderBy('created_at','desc')->limit(6)->get();
        foreach ($services as $item) {
            $item['image'] =  $item->gallery[0]->url;
            $item['savedCount'] = count( $item->isSaved);

        }
        return $this->returnData('services' , $services );
    }

    
}
