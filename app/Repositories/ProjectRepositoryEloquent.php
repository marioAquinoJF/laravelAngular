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

    public function isOwner($userId, $projectId)
    {
        return !(count(Project::where(['id' => $projectId, 'owner_id' => $userId])->get())) ? false : true;
    }

    public function hasMember($memberId, $projectId)
    {
        return $this->skipPresenter()->find($projectId)->members()->where('user_id', $memberId)->limit(1)->get();
    }

    public function checkProjectPermitions($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        if ($this->isOwner($userId, $projectId) or $this->checkProjectMember($userId, $projectId)) {
            return true;
        }
        return false;
    }

    public function presenter()
    {
        return ProjectPresenter::class;
    }

    public function getFullProject($id)
    {
        return $this->skipPresenter->with(['owner', 'client', 'tasks', 'notes', 'members'])->find($id);
    }

    public function checkProjectMember($user_id, $project_id)
    {
        return count($this->hasMember($user_id, $project_id)) > 0 ? true : false;
    }

    // methods with relations
    public function getMember($member_id, $id)
    {
        return Project::find($id)->members()->where('user_id', $member_id)->limit(1)->get();
    }

    public function getTask($id, $task_id)
    {
        return Project::find($id)->tasks()->where('id', $task_id)->limit(1)->get();
    }

    public function removeMembers($projectId)
    {
        return Project::find($projectId)->members()->detach();
    }

    public function removeTasks($projectId)
    {
        return Project::find($projectId)->tasks()->delete();
    }

    public function removeNotes($projectId)
    {
        return Project::find($projectId)->notes()->delete();
    }

    public function removeProject($projectId)
    {
        $project = Project::find($projectId);
        if (!is_null($project)) {
            $project->members()->detach();
            $project->tasks()->delete();
            $project->notes()->delete();
            return $project->delete();
        }
        return true;
    }

}
