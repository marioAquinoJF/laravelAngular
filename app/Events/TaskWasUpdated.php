<?php

namespace larang\Events;

use larang\Entities\ProjectTask;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TaskWasUpdated extends Event implements ShouldBroadcast
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
            'user.' . \Authorizer::getResourceOwnerId()
        ];
    }

}
