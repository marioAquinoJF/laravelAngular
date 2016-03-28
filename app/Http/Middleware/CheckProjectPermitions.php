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
        $project_id = $request->route('id') ? $request->route('id') : $request->route('project');
        //dd($project_id);
        if (!$this->service->checkProjectPermitions($project_id)):
            return ['error' => 'Access forbiden or inexistent project!'];
        endif;
        return $next($request);
    }

}
