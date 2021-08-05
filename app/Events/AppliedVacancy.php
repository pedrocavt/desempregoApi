<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AppliedVacancy
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $candidate;
    public $vacancy;
    public $ownerVacancy;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($candidate, $vacancy, $ownerVacancy)
    {
        $this->candidate = $candidate;
        $this->vacancy = $vacancy;
        $this->ownerVacancy = $ownerVacancy;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
