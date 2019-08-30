<?php

namespace App\Observers;

use App\Jobs\SendPushNotification;
use App\Models\NotificationUser;

class NotificationObserver
{
    /**
     * @param NotificationUser $notificationUser
     */
    public function created(NotificationUser $notificationUser)
    {
        $message = $notificationUser->notification->message;
        $deviceData = $notificationUser->user->devices->toArray();

        $job = new SendPushNotification($message, $deviceData, '');
        dispatch($job);
    }
}
