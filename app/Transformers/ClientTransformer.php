<?php

namespace larang\Transformers;

use League\Fractal\TransformerAbstract;
use larang\Entities\Client;

class ClientTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['projects'];
    public function transform(Client $model)
    {
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

    public function includeProjects(Client $client)
    {
        $transformer = new ProjectTransformer();
        $transformer->setDefaultIncludes([]);        
        return $this->collection($client->projects, $transformer);
    }

}
