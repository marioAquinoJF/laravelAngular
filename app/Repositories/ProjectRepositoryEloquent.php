<?php

namespace larang\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use larang\Presenters\ProjectPresenter;
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

    public function hasMember($memberId, $projectId)
    {
        return $this->skipPresenter()->find($projectId)->members()->where('member_id', $memberId)->limit(1)->get();
    }

    public function presenter()
    {
        return ProjectPresenter::class;
    }

    public function getFullProject($id)
    {
        return $this->skipPresenter->with(['owner', 'client', 'tasks', 'notes', 'members'])->find($id);
    }

    // methods with relations
    public function getMember($member_id, $id)
    {
        return $this->find($id)->members()->where('member_id', $member_id)->limit(1)->get();
    }

    public function getTask($id, $task_id)
    {
        return $this->find($id)->tasks()->where('id', $task_id)->limit(1)->get();
    }

    public function removeMembers($projectId)
    {
        return $this->find($projectId)->members()->detach();
    }

    public function removeTasks($projectId)
    {
        return $this->find($projectId)->tasks()->delete();
    }

    public function removeNotes($projectId)
    {
        return $this->find($projectId)->notes()->delete();
    }

    public function removeProject($projectId)
    {
        $project = $this->find($projectId);
        if (!is_null($project)) {
            $project->members()->detach();
            $project->tasks()->delete();
            $project->notes()->delete();
            return $project->delete();
        }
        return true;
    }

// METHODS TO RELATIONS WITH USERS
    public function findWithOwnerAndMember($userId)
    {
       /* return $this->scopeQuery(function($queryBuilder) use($userId) {
                    return $queryBuilder->select('projects.*')
                                    ->join('projects_members', function($join){// 'projects_members.project_id', '=', 'projects.id')
                                        $join('projects')
                                    })->paginate();
                                  //  ->where('projects_members.member_id', '=', $userId);
                                  //  ->union($this->model->query()->getQuery()->where('owner_id', '=', $userId));
                });*/
    }
    public function findAsMember($userId)
    {
        return $this->scopeQuery(function($queryBuilder) use($userId) {
                    return $queryBuilder->select('projects.*')
                                    ->leftJoin('projects_members', 'projects_members.project_id', '=', 'projects.id')
                                    ->where('projects_members.member_id', '=', $userId);
                })->paginate();
    }
    public function findOwner($userId, $limit = null, $columns = [])
    {
        return $this->scopeQuery(function($queryBuilder) use($userId) {
                    return $queryBuilder->select('projects.*')->where('projects.owner_id', '=', $userId);
                })->paginate($limit, $columns);
    }

}
