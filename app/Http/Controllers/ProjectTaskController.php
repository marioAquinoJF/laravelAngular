<?php

namespace larang\Http\Controllers;

use Illuminate\Http\Request;
use larang\Repositories\ProjectTaskRepository;
use larang\Services\ProjectTaskService;

class ProjectTaskController extends Controller
{

    private $repository;
    private $service;

    public function __construct(ProjectTaskRepository $repository, ProjectTaskService $sevice)
    {
        $this->repository = $repository;
        $this->service = $sevice;
        $this->middleware('CheckProjectOwner', ['only' =>
            [
                'destroy'
            ]
                ]
        );

        $this->middleware('CheckProjectPermitions', ['only' =>
            [
                'store',
                'show',
                'update',
                'index'
            ]
                ]
        );
    }

    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
    }

    public function store($id, Request $request)
    {
        $p = ['project_id' => $id];
        return $this->service->create(array_merge($p, $request->all()));
    }

    public function show($id, $task)
    {
        try{
            return $this->repository->findWhere(['id' => $task, 'project_id' => $id]);
        } catch (\Exception $ex) {
            return [false];
        }
        
    }

    public function update($id, $task, Request $request)
    {
        try{
            return $this->service->update(array_merge($request->all(), ['project_id' => $id]), $task);
        } catch (\Exception $ex) {
            return [false];
        }
        
    }

    public function destroy($id, $task)
    {
        try {
            return [$this->repository->delete($task)];
        } catch (\Exception $ex) {
            return [false];
        }
    }

}
