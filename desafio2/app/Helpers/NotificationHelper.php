<?php
namespace App\Helpers;

class NotificationHelper
{
    public static function sendNotification($type, $message)
    {        
        session()->flash('notification', [
            'type' => $type,
            'message' => $message,
        ]);
    }
}
