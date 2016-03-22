<?php

namespace larang\Http\Middleware;

use Closure;
use larang\Services\ProjectService;

class CheckProjectOwner
{

    protected $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }

    public function handle($request, Closure $next)
    {
        $userId = \Authorizer::getResourceOwnerId();
        if (!$this->service->isOwner($userId, $request->project)):
            return ['error' => 'Access forbiden or inexistent project!'];
        endif;
        return $next($request);
    }

}
