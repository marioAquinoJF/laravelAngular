<?php

namespace larang\Transformers;

use larang\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;

class ProjectNoteTransformer extends TransformerAbstract
{

    public function transform(ProjectNote $model)
    {
        return [
            'id' => $model->id,
            'project_id' => $model->project_id,
            'title' => $model->title,
            'note' => $model->note,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }

}
