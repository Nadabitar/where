<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdsStoreRequest;
use App\Models\Gallery;
use App\Models\Places;
use App\Models\promo;
use App\Models\Service;
use App\Traits\GenralTraits;
use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PromoController extends Controller
{
    use GenralTraits;
    use ImageTraits;

    public function get_Place()
    {
        return Places::where('accountId' , Auth::user()->id)->first();
    }
    public function index()
    {
        $place = $this->get_Place();
        $services = Service::has('gallery')->where('placeId' , $place->id)->get();
        // $Gallery  = Places::with('Gallery')->where('accountId' , Auth::user()->id)->first()->Gallery;
        $Gallery = Gallery::WhereHas('service' , function ($query)
        {
            $query->where('placeId' , $this->get_Place()->id)->where('isAd' , 1);
        })->latest()->get();
        return View('subscriber.pages.Service.addPromo' ,  compact('services' , 'place' , 'Gallery'));
    }

    public function store(AdsStoreRequest $request , $id)
    {
        $request->validated();
        $service = new Service();
        $service->placeId = $id ;
        $service->content = $request->content;
        $service->title =  "advertising";
        $service->isAd = true;
        $service->save();
    
        if($result =  $this->getUrlImage($service , $request)){
            return redirect()->back()->with([
                'message' => 'Service Added successfully',
                'alert-type' => 'success'
            ]);
        }else{
            return back()->with(['error' => 'Something went error']);
        }
    }

    public function show(promo $promo)
    {
        
    }

    public function edit(promo $promo)
    {
        //
    }

    public function update(Request $request, promo $promo)
    {
        //
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();
        return redirect()->back();
    }

    public function getUrlImage(Service $service , Request $request)
    {
        $image = $request->hasFile('image')? $this->uploadImage($request->file('image')->getRealPath()): $this->returnError(201 , 'image is required') ;
        $gallary = new Gallery();
        $gallary->url = $image;

        $result = $service->gallery()->save($gallary);

        return $result;
    }

    public function getPromoUrl()
    {
        $promo = DB::select(' select services.* , galleries.url as url 
        from services join  galleries
        on  services.id = galleries.serviceId
        where services.isPromo = 1
         ORDER BY services.created_at');

        if ($promo) {
            return $this->returnData('promo' , $promo );
        }else{
            return $this->returnError('404' , "No promo to display");
        }
    }
}
