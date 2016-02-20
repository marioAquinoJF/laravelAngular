<?php

namespace larang\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use larang\Entities\ProjectFile;
use larang\Presenters\ProjectFilePresenter;
/**
 * Class PorjectFileRepositoryEloquent
 * @package namespace larang\Repositories;
 */
class ProjectFileRepositoryEloquent extends BaseRepository implements ProjectFileRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectFile::class;
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
        return ProjectFilePresenter::class;
    }
}
