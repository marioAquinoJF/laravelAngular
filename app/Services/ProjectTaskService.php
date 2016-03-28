<?php

namespace larang\Services;

use larang\Repositories\ProjectTaskRepository;
use larang\Repositories\ProjectRepository;
use larang\Validators\ProjectTaskValidator;

class ProjectTaskService extends Service
{

    protected $repository;
    protected $projectRepository;
    protected $validator;

    public function __construct(ProjectTaskRepository $repository,ProjectRepository $projectRepository, ProjectTaskValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->projectRepository = $projectRepository;
    }


}
