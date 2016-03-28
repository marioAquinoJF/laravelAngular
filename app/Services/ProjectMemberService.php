<?php

namespace larang\Services;

use larang\Repositories\ProjectMemberRepository;
use larang\Validators\ProjectMemberValidator;

/**
 * Description of ClientService
 *
 * @author Mario
 */
class ProjectMemberService extends Service
{

    protected $repository;
    protected $validator;

    public function __construct(ProjectMemberRepository $repository, ProjectMemberValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /*public function create(array $data)
    {
     //   dd(isset($data['project_id']) && isset($data['member_id']) && !is_null($data['member_id']));
        if (isset($data['project_id']) && isset($data['member_id']) && !is_null($data['member_id'])) {
            $pm = $this->repository->skipPresenter()->findWhere(['project_id' => $data['project_id'], 'member_id' => $data['member_id']]);
            dd($pm);
            if (!$pm):
                return parent::create($data);
            endif;
        }
        return ['error'=>'Membro Inválido'];
    }*/

}
