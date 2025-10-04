<?php

namespace App\Events;

use App\Models\Vote;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VoteCast implements ShouldBroadcast
{
    public $candidateId;

    public function __construct($candidateId)
    {
        $this->candidateId = $candidateId;
    }

    public function broadcastOn()
    {
        return new Channel('votes');
    }
}
