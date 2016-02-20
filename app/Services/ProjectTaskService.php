<?php

namespace larang\Services;

use larang\Repositories\ProjectTaskRepository;
use larang\Validators\ProjectTaskValidator;

class ProjectTaskService extends Service
{

    protected $repository;
    protected $validator;

    public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function addMember($projectId, $userId)
    {
        $project = $this->repository->find($projectId);
        return $project->members()->attach($userId);
    }

    public function removeMember($projectId, $userId)
    {
        return $this->repository->find($projectId)->members()->detach($userId);
    }

}
