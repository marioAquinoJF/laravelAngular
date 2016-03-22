<?php

namespace larang\Services;

use larang\Entities\Project;
use larang\Repositories\ProjectRepository;
use larang\Services\ProjectFileService;
use larang\Validators\ProjectValidator;

class ProjectService extends Service
{

    protected $repository;
    protected $validator;
    protected $serviceFile;

    public function __construct(ProjectRepository $repository, ProjectFileService $serviceFile, ProjectValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->serviceFile = $serviceFile;
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
        return $this->repository->skipPresenter()->find($projectId)->members()->detach($userId);
    }

    public function removeTasks($projectId, $userId)
    {
        return $this->repository->find($projectId)->members()->detach($userId);
    }

    public function delete($id)
    {
        $files = $this->repository->skipPresenter()->find($id)->files;
        foreach ($files as $file) {
            $this->serviceFile->deleteFile($file->id);
        }
        if (count($this->repository->skipPresenter()->find($id)->files) === 0) {
            return $this->repository->removeProject($id);
        }
        return [false];
    }

// Permitions
    public function checkProjectPermitions($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        if ($this->isOwner($userId, $projectId) or $this->checkProjectMember($userId, $projectId)) {
            return true;
        }
        return false;
    }

    public function checkProjectMember($userId, $projectId)
    {
        return count($this->hasMember($userId, $projectId)) > 0 ? true : false;
    }
    public function hasMember($memberId, $projectId)
    {
        return $this->repository->skipPresenter()->find($projectId)->members()->where('user_id', $memberId)->limit(1)->get();
    }
    public function isOwner($userId, $projectId)
    {
        return !(count(Project::where(['id' => $projectId, 'owner_id' => $userId])->get())) ? false : true;
    }

}
