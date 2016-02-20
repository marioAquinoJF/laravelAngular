<?php

namespace larang\Services;

use larang\Repositories\ProjectNoteRepository;
use larang\Validators\ProjectNoteValidator;

/**
 * Description of ProjectService
 *
 * @author Mario
 */
class ProjectNoteService extends Service
{

    protected $repository;
    protected $validator;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }


}
