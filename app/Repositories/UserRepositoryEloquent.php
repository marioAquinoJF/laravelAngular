<?php

namespace larang\Repositories;

use larang\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use larang\Repositories\UserRepository;
use larang\Presenters\UserPresenter;

/**
 * Class UserRepositoryRepositoryEloquent
 * @package namespace larang\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
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
        return UserPresenter::class;
    }

}
