<?php

namespace larang\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use larang\Repositories\ProjectTaskRepository;
use larang\Entities\ProjectTask;
use larang\Presenters\ProjectTaskPresenter;

/**
 * Class ProjectTaskRepositoryEloquent
 * @package namespace larang\Repositories;
 */
class ProjectTaskRepositoryEloquent extends BaseRepository implements ProjectTaskRepository
{

    protected $fieldSearchable = [
        'name'
    ];

    public function model()
    {
        return ProjectTask::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return ProjectTaskPresenter::class;
    }

    public function findFromOwnerAndMember($userId, $limit = null, $columns = [])
    {
        return $this->scopeQuery(function($queryBuilder) use($userId) {
                    return $queryBuilder->select('project_tasks.*')->distinct()
                                    ->join('projects', 'projects.id', '=', 'project_tasks.project_id')
                                    ->where('projects.owner_id', '=', $userId)->orderBy('id');
                })->paginate($limit, $columns);
    }

    public function orderBy($projectId, $orderBy = 'id', $limit = null, $columns = [])
    {
        return $this->scopeQuery(function($queryBuilder) use($projectId, $orderBy) {
                    return $queryBuilder->select('project_tasks.*')
                                    ->where('projects.owner_id', '=', $projectId)->orderBy($orderBy);
                })->paginate($limit, $columns);
    }

}
