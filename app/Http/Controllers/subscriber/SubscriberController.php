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
            $services = Service::where('placeId' , $place->id)->latest()->get();
            $promote =Service::where(['placeId'=> $place->id , 'isAd' => true ])->latest()->get();
            $comments = Places::where('id' , $place->id)->first();
            // $users = $this->numberUsers($place->id);
            // $popularService = $this->popular($place->id);
            return view('subscriber.pages.dashboard')->with([
                'place' => $place ,
                'services' =>  $services,
                'promote'=> $promote,
                'comments' => $comments->comment,
                // 'users' => $users,s
                // 'popularService' => $popularService
            ]);
        }
        return  View('errors.503');
    }

    public function popular($id)
    {
        
    }
}

