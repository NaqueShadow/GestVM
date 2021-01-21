<?php

namespace App\Events;

use App\Models\Attribution;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Attr_event
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $attr;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Attribution $attribution)
    {
        $this->attr = $attribution;
        $this->attr->load('mission', 'chauffeur', 'vehicule');
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
