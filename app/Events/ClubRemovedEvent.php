<?php

namespace App\Events;

use App\Models\Club;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClubRemovedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Club
     */
    public $club;

    /**
     * Create a new event instance.
     *
     * @param Club $club
     */
    public function __construct(Club $club)
    {
        //
        $this->club = $club;
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
