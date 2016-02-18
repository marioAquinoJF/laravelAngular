<?php

namespace larang\Transformers;

use League\Fractal\TransformerAbstract;
use larang\Entities\ProjectTask;

/**
 * Description of ProjectTransformer
 *
 * @author Mario
 */
class ProjectTaskTransformer extends TransformerAbstract
{

    public function transform(ProjectTask $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'start_date' => $model->start_date,
            'due_date' => $model->due_date,
            'status' => $model->status,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }

}
