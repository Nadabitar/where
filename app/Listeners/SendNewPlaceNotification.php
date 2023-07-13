<?php

namespace App\Listeners;

use App\Events\placeCreated;
use App\Models\User;
use App\Notifications\NewPlaceRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewPlaceNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(placeCreated $event)
    {
        $admins = User::where('userType', 'admin')->get();

        Notification::send($admins, new NewPlaceRegistered($event->user));
    }
}
