<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewVacancy
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $title;
    public $description;
    public $wage;

    /**
     * Create a new event instance.
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
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
