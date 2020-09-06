<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AccessLevelUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public bool $upgrade;

    /**
     * Create a new event instance.
     *
     * @param User $user
     */
    public function __construct(User $user, $upgrade)
    {
        $this->user = $user;
        $this->upgrade = $upgrade;
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
