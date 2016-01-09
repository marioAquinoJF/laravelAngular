<?php

namespace larang\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use larang\Repositories\ProjectRepository;
USE larang\Presenters\ProjectPresenter;
use larang\Entities\Project;

/**
 * Class ProjectRepositoryEloquent
 * @package namespace larang\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function isOwner($userId, $projectId)
    {
        return count(Project::where(['id' => $projectId, 'owner_id' => $userId])) > 0;
    }

    public function hasMember($memberId, $projectId)
    {
        $member = Project::find($projectId)->members()->where('user_id', $memberId)->limit(1)->get();
        return count($member) ? $member[0] : false;
    }

    public function presenter()
    {
        return ProjectPresenter::class;
    }

    public function getFullProject($id)
    {
        return $this->with(['owner', 'client', 'tasks', 'notes', 'members'])->find($id);
    }

}
