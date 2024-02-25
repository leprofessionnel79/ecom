<?php

namespace App\Http\Controllers;

use auth;
use Illuminate\Http\Request;
use App\Models\Notifications;

class SSEController extends Controller
{
    public function sendSSE()
    {
        $notifications = Notifications::where('user_id',auth()->user()->id)
        ->where('is_send',0)
        ->first();

        header('Content-Type: text/event-stream');
        header('Cashe-Control: no-cashe');
        header('Connection: keep-alive');

        if($notifications){
           $eventData = [
            'message'=> $notifications->message,
           ];

           echo "data:".json_encode($eventData)."\n\n";
           $notifications->is_send = 1;
           $notifications->update();
        }else{
            echo "\n\n";
        }

        ob_flush();
        flush();
    }

}
