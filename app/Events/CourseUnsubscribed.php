<?php

namespace Pilot\Events;

use Pilot\CourseRecord;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CourseUnsubscribed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $courseRecord;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(CourseRecord $courseRecord)
    {
        $this->courseRecord = $courseRecord;
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
