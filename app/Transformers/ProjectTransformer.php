<?php

namespace larang\Transformers;

use League\Fractal\TransformerAbstract;
use larang\Entities\Project;

class ProjectTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [ 'owner', 'members', 'client', 'tasks', 'notes', 'files'];

    public function transform(Project $model)
    {
        return [
            'id' => $model->id,
            'client_id' => $model->client_id,
            'name' => $model->name,
            'description' => $model->description,
            'progress' => (int) $model->progress,
            'status' => $model->status,
            'due_date' => $model->due_date,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
            'is_member' => $model->owner_id != \Authorizer::getResourceOwnerId(),
        ];
    }

    public function includeMembers(Project $model)
    {
        return $this->collection($model->members, new MemberTransformer());
    }

    public function includeClient(Project $model)
    {
        return $this->item($model->client, new ClientTransformer());
    }

    public function includeOwner(Project $model)
    {
        return $this->item($model->owner, new UserTransformer());
    }

    public function includeTasks(Project $model)
    {
        return $this->collection($model->tasks, new ProjectTaskTransformer());
    }

    public function includeNotes(Project $model)
    {
        return $this->collection($model->notes, new ProjectNoteTransformer());
    }

    public function includeFiles(Project $model)
    {
        return $this->collection($model->files, new ProjectFileTransformer());
    }

}
