<?php

namespace App\Trait;

use App\Mail\PasswordChangedNotificationMail;
use App\Observers\PasswordChangeObserver;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

trait PasswordChangedNotificationTrait{
    public static function booted()
    {
        static::observe(PasswordChangeObserver::class);
    }

    public function passwordColumnName(): string
    {
        return 'password';
    }

    public function emailColumnName(): string
    {
        return 'email';
    }

    public function passwordChangeNotificationMail(): Mailable
    {
        return new PasswordChangedNotificationMail;
    }

    public function isPasswordChanged(): bool
    {
        return $this->wasChanged($this->passwordColumnName());
    }

    public function shouldPasswordChangedNotificationMailBeQueued(): bool
    {
        return false;
    }

    public function sendPasswordChangedNotification(): void
    {
        if(!$this->isPasswordChanged()){
            return;
        }

        $mail = Mail::to($this->getRawOriginal($this->emailColumnName()));

        if($this->shouldPasswordChangedNotificationMailBeQueued()){
            $mail->queue($this->passwordChangeNotificationMail());
            return;
        }

        $mail->send($this->passwordChangeNotificationMail());
    }
}
