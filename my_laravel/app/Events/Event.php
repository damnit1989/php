<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Event
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name;

    public $sender;

    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($name,$sender,$data)
    {
        //
        $this->name = $name;
        $this->sender = $sender;
        $this->data = $data;
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

    public function getName(){
        return $this->name;
    }
}
