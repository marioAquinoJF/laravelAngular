<?php

namespace larang\Services;

use larang\Repositories\ProjectTaskRepository;
use larang\Validators\ProjectTaskValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectTaskService {

    protected $repository;
    protected $validator;

    public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator) {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data) {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (ValidatorException $ex) {
            return [
                'error' => TRUE,
                'message' => $ex->getMessageBag()
            ];
        }
    }

    public function update(array $data, $id) {
        return $this->repository->update($data, $id);
    }

    public function addMember($projectId, $userId) {
        $project = $this->repository->find($projectId);
        return $project->members()->attach($userId);
    }

    public function removeMember($projectId, $userId) {
        return $this->repository->find($projectId)->members()->detach($userId);
    }

}
