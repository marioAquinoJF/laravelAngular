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
        $project_id = $request->route('id') ? $request->route('id') : $request->route('project');
        if (!$this->service->isOwner($userId, $project_id)):
            return ['error' => 'Access forbiden or inexistent project!'];
        endif;
        return $next($request);
    }

}
