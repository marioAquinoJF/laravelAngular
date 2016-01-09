<?php

namespace larang\Transformers;

use League\Fractal\TransformerAbstract;
use larang\Entities\Client;

class ClientTransformer extends TransformerAbstract
{

    public function transform(Client $model)
    {
        $model = $p->client;
        return [
            'id' => $model->id,
            'name' => $model->name,
            'responsible' => $model->responsible,
            'email' => $model->email,
            'phone' => $model->phone,
            'address' => $model->address,
            'obs' => $model->obs,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

}
