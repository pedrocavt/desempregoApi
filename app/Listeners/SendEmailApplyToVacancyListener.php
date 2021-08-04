<?php

namespace App\Listeners;

use App\Events\SendEmailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailApplyToVacancyListener
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
     * @param  SendEmailEvent  $event
     * @return void
     */
    public function handle(SendEmailEvent $event)
    {
        //
    }
}
