<?php

namespace larang\Http\Middleware;

use Closure;
use larang\Repositories\ProjectRepository;

class CheckProjectPermitions
{

    protected $repository;

    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($request, Closure $next)
    {
        if (!$this->repository->checkProjectPermitions($request->project)):
            return ['error' => 'Access forbiden or inexistent project!'];
        endif;
        return $next($request);
    }

}
