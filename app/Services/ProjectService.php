<?php

namespace larang\Services;

use larang\Entities\Project;
use larang\Repositories\ProjectRepository;
use larang\Validators\ProjectValidator;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class ProjectService extends Service
{

    protected $repository;
    protected $validator;
    private $fileSystem;
    private $storage;

    public function __construct(ProjectRepository $repository, ProjectValidator $validator, Filesystem $fileSystem, Storage $storage)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->fileSystem = $fileSystem;
        $this->storage = $storage;
    }

    public function addMember($project_id, $user_id)
    {
        $member = $this->repository->hasMember($user_id, $project_id);
        if (count($member) === 0) {
            return is_null(Project::find($project_id)->members()->attach($user_id));
        }
        return false;
    }

    public function removeMember($projectId, $userId)
    {
        return $this->repository->find($projectId)->members()->detach($userId);
    }

    public function removeTasks($projectId, $userId)
    {
        return $this->repository->find($projectId)->members()->detach($userId);
    }

    public function delete($id)
    {
        return $this->repository->removeProject($id);
    }

}
