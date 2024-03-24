<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class ImportUpdated implements ShouldBroadcastNow
{
    use SerializesModels;

    public string $importID;
    public int $row;

    /**
     * Create a new event instance.
     */
    public function __construct(string $importID, int $row)
    {
        $this->importID = $importID;
        $this->row = $row;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel( 'imports'),
        ];
    }
}
