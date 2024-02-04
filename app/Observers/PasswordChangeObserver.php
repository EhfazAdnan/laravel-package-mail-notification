<?php

namespace App\Observers;

use App\Mail\PasswordChangedNotificationMail;
use Illuminate\Support\Facades\Mail;

class PasswordChangeObserver
{
    public function updated($model){

        if(!$model->isPasswordChanged()){
            return;
        }

        $mail = Mail::to($model->getRawOriginal($model->emailColumnName()));

        if($model->shouldPasswordChangedNotificationMailBeQueued()){
            $mail->queue($model->passwordChangeNotificationMail());
            return;
        }

        $mail->send($model->passwordChangeNotificationMail());

    }
}
