<?php

namespace larang\Events;

use larang\Entities\ProjectTask;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class TaskWasIncluded extends Event implements ShouldBroadcast
{

    use SerializesModels;

    /**
     *
     * @var ProjectTask
     */
    public $task;

    public function __construct(ProjectTask $task)
    {
        $this->task = $task;
    }

    public function broadcastOn()
    {
        return [
            'user.1'
        ];
    }

}
