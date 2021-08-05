<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewVacancyPostedMail extends Mailable
{
    use Queueable, SerializesModels;


    public $title;
    public $description;
    public $wage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $description, $wage)
    {
        $this->title = $title;
        $this->description = $description;
        $this->wage = $wage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.new-vacancy');
    }
}
