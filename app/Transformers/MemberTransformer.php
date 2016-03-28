<?php

namespace larang\Transformers;

use League\Fractal\TransformerAbstract;
use larang\Entities\User;

class MemberTransformer extends TransformerAbstract
{

    public function transform(User $model)
    {

        return [
            'member_id' => $model->id,
            'name' => $model->name
        ];
    }

}
