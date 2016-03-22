<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace larang\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use larang\Repositories\ClientRepository;
use larang\Entities\Client;
use larang\Presenters\ClientPresenter;

/**
 * Description of ClientRepositoryEloquent
 *
 * @author Mario
 */
class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    protected $fieldSearchable =[
        'name'
    ];

    public function model()
    {
        return Client::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    
    public function presenter()
    {
        return ClientPresenter::class;
    }

}
