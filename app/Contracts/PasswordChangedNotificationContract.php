<?php

namespace App\Contracts;

use Illuminate\Mail\Mailable;

interface PasswordChangedNotificationContract
{
    public function passwordColumnName(): string;
    public function emailColumnName(): string;
    public function passwordChangeNotificationMail(): Mailable;
    public function isPasswordChanged(): bool;
    public function shouldPasswordChangedNotificationMailBeQueued(): bool;
    public function sendPasswordChangedNotification(): void;
}
