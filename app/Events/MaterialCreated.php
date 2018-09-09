<?php

namespace Pilot\Events;

use Pilot\Material;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MaterialCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $material;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Material $material)
    {
        $this->material = $material;
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
