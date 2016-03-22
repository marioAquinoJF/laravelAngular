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
        return $this->skipPresenter()->find($projectId)->members()->where('user_id', $memberId)->limit(1)->get();
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
        return $this->find($id)->members()->where('user_id', $member_id)->limit(1)->get();
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

}
