<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppliedVacancy extends Mailable
{
    use Queueable, SerializesModels;


    public $vacancy;
    public $nameUser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($vacancy, $nameUser)
    {
        $this->vacancy = $vacancy;
        $this->nameUser = $nameUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.applied-vacancy');
    }
}
