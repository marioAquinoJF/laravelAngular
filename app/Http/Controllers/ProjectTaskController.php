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
    }

    public function index($id, Request $request)
    {
        
        if (!isset($request->id)) {
            return $this->repository->findWhere(['project_id' => $id]);
        }
        return $this->repository->findWhere($request->all());
    }

    public function search(Request $request)
    {
        return $this->repository->findFromOwnerAndMember(\Authorizer::getResourceOwnerId(), $request->get('limit'));
    }

    public function store($id, Request $request)
    {
        return $this->service->create(array_merge($request->all(), ['project_id' => $id]));
    }

    public function show($id, $task)
    {
        return $this->repository->find($task);
    }

    public function update($id, $task, Request $request)
    {
        return $this->service->update(array_merge($request->all(), ['project_id' => $id]), $task);
    }

    public function destroy($id, $task)
    {
        $this->repository->delete($task);
    }

}
