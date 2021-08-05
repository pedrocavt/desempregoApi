<?php

namespace App\Listeners;

use App\Entities\User;
use App\Events\NewVacancy;
use App\Mail\NewVacancyPostedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailNewVacancy implements ShouldQueue
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
     * @param \App\Events\NewVacancy  $event
     * @return void
     */
    public function handle(NewVacancy $event)
    {
        $users = User::all();

        foreach ($users as $indice => $user) {
            $multi = $indice + 1;

            $email = new NewVacancyPostedMail($event->title, $event->description, $event->wage);

            $email->subject("Vaga Nova");

            $when = now()->addSecond($multi * 7);
            Mail::to($user)->later($when, $email);
        }
    }
}
