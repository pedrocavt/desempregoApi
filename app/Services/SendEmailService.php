<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class SendEmailService
{

    public static function sendEmail($user, $email)
    {
        Mail::to($user)->send($email);
    }
}
