<?php

namespace App\Listeners;

use App\Events\AppliedVacancy;
use App\Mail\AppliedVacancyMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailAppliedVacancy implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AppliedVacancy  $event
     * @return void
     */
    public function handle(AppliedVacancy $event)
    {
        $email = new AppliedVacancyMail($event->candidate, $event->vacancy);

        $email->subject("Novo Candidato");

        Mail::to($event->ownerVacancy)->queue($email);
    }
}
