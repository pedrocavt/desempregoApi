<?php

namespace App\Providers;

use App\Events\AppliedVacancy;
use App\Events\NewVacancy;
use App\Listeners\SendEmailAppliedVacancy;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Listeners\SendEmailNewVacancy;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ], NewVacancy::class => [
            SendEmailNewVacancy::class
        ], AppliedVacancy::class => [
            SendEmailAppliedVacancy::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
