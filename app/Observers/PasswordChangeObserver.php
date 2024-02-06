<?php

namespace App\Observers;

use App\Contracts\PasswordChangedNotificationContract;
use App\Mail\PasswordChangedNotificationMail;
use Illuminate\Support\Facades\Mail;

class PasswordChangeObserver
{
    public function updated(PasswordChangedNotificationContract $model){
       $model->sendPasswordChangedNotification();
    }
}
