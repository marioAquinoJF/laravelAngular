<?php

namespace larang\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use larang\Repositories\ProjectMemberRepository;
use larang\Entities\ProjectMember;
use larang\Presenters\ProjectMemberPresenter;

class ProjectMemberRepositoryEloquent extends BaseRepository implements ProjectMemberRepository
{

    public function model()
    {
        return ProjectMember::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return ProjectMemberPresenter::class;
    }

}
