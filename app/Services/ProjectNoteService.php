<?php


namespace larang\Services;

use larang\Repositories\ProjectNoteRepository;
use larang\Validators\ProjectNoteValidator;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Description of ProjectService
 *
 * @author Mario
 */
class ProjectNoteService {

    protected $repository;
    protected $validator;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator) {
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

}
