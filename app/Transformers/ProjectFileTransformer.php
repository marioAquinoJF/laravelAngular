<?php

namespace larang\Transformers;

use larang\Entities\ProjectFile;
use League\Fractal\TransformerAbstract;

class ProjectFileTransformer extends TransformerAbstract
{

    public function transform(ProjectFile $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'description' => $model->description,
            'lable' => $model->lable,
            'extension' => $model->extension,
            'project_id' => $model->project_id,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }

}
