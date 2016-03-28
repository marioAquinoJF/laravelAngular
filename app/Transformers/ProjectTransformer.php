<?php

namespace larang\Transformers;

use League\Fractal\TransformerAbstract;
use larang\Entities\Project;

class ProjectTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [ 'members', 'client'];

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

}
