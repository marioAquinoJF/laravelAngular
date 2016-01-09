<?php

namespace larang\Http\Middleware;

use Closure;
use larang\Repositories\ProjectRepository;

class CheckProjectOwner {

    protected $repository;

    public function __construct(ProjectRepository $repository) {
        $this->repository = $repository;
    }

    public function handle($request, Closure $next) {
        
        $userId = \Authorizer::getResourceOwnerId();
        $project_id = $request->id;
        
        if (!$this->repository->isOwner($userId, $project_id)):
            return ['error' => 'Access forbiden!'];
        endif;
        return $next($request);
    }

}
