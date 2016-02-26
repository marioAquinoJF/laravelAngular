<?php

namespace larang\Http\Middleware;

use Closure;
use larang\Repositories\ProjectRepository;

class CheckProjectOwner
{

    protected $repository;

    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($request, Closure $next)
    {
        $userId = \Authorizer::getResourceOwnerId();
        if (!$this->repository->isOwner($userId, $request->project)):
            return ['error' => 'Access forbiden or inexistent project!'];
        endif;
        return $next($request);
    }

}
