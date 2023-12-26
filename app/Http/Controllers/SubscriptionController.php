<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\Subscription;
use Illuminate\Support\Facades\Notification;

class SubscriptionController extends Controller
{
    public function sendSubscriptionNotification()
    {
        $data = [
            'body' => 'Your subscription has been expired, but its easy to get connected again.',
            'actionText' => 'Renew',
            'url' => url('/'),
            'endingText' => 'To keep using our services without interruption, click the renew button to subscribe again. Thank you!'
        ];


        $user = User::first();

        // $user->notify(new Subscription($data));
        Notification::send($user, new Subscription($data));
    }
}
