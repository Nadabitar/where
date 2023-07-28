<?php

namespace App\Http\Controllers\subscriber;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Places;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriberController extends Controller
{
    public function index()
    {
        $place = Places::where('accountId' , Auth::user()->id)->first();

        if ($place->isAccepted) {
            $services = Service::where('placeId' , $place->id)->orderBy('created_at','desc')->take(9)->get();
            $promote =Service::where(['placeId'=> $place->id , 'isPromo' => true ])->latest()->get();
            $comments = $place->comment ? $place->comment : null;
            $users =  $place->isSaved();
            $popularService = Service::find($this->popular($place));
            return view('subscriber.pages.dashboard')->with([
                'place' => $place ,
                'services' =>  $services,
                'promote'=> $promote,
                'comments' => $comments,
                'users' => $users,
                'popularService' => $popularService
            ]);
        }
        return  View('errors.503');
    }

    public function popular(Places  $place)
    {
        if (count($place->services) == 0 ) {
            return null;
        }else{
            $service = Service::where('placeId' ,  $place->id)->max('count');
            return $service;
        }
    }
}

