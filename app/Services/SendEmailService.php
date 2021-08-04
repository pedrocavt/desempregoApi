<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class SendEmailService
{

    public static function sendEmail($user, $email, $multi)
    {
        $when = now()->addSecond($multi * 7);
        Mail::to($user)->later($when, $email);
    }
}
