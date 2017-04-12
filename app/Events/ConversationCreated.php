<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Conversation;
use App\Transformers\ConversationTransformer;


class ConversationCreated implements ShouldBroadcast
{
    use InteractsWithSockets;

    public $conversation;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Conversation $conversation)
    {
        $this->conversation = $conversation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        $channels = [];

        $this->conversation->usersExceptCurrentlyAuthenticated->each(function ($user) use (&$channels) {
            $channels[] = new PrivateChannel('user.' . $user->id);
        });

        //dd($channels);

        return $channels;
    }

    public function broadcastWith()
    {
        return fractal()
            ->item($this->conversation)
            ->parseIncludes(['user', 'users'])
            ->transformWith(new ConversationTransformer)
            ->toArray();
    }
}
