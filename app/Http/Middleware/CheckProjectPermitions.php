<?php

namespace larang\Http\Middleware;

use Closure;
use larang\Services\ProjectService;

class CheckProjectPermitions
{

    protected $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }

    public function handle($request, Closure $next)
    {
        if (!$this->service->checkProjectPermitions($request->project)):
            return ['error' => 'Access forbiden or inexistent project!'];
        endif;
        return $next($request);
    }

}
