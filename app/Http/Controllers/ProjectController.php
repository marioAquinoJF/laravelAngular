<?php

namespace larang\Http\Controllers;

use Illuminate\Http\Request;
use larang\Repositories\ProjectRepository;
use larang\Services\ProjectService;

class ProjectController extends Controller
{

    private $repository;
    private $service;

    public function __construct(ProjectRepository $repository, ProjectService $sevice)
    {
        $this->repository = $repository;
        $this->service = $sevice;
        $this->middleware('CheckProjectOwner', ['only' =>
            [
                'removeMember',
                'newMember',
                'destroy',
            ]
                ]
        );

        $this->middleware('CheckProjectPermitions', ['only' =>
            [
                'getMembers',
                'getMember',
                'getTask',
                'getFiles',
                'getFile',
                'show',
                'update',
            ]
                ]
        );
    }

    public function index()
    {
        return $this->repository->all();
    }

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id)
    {
        try {
            return $this->repository->find($id);
        } catch (\Exception $ex) {
            return [false];
        }
    }

    public function update($id, Request $request)
    {
        try {
            return $this->service->update($request->all(), $id);
        } catch (Exception $ex) {
            return [false];
        }
    }

    public function destroy($id)
    {
        try{
            return $this->service->delete($id);
        } catch (Exception $ex) {
            return [false];
        }
        
    }

// METHODS TO RELATIONS WITH MEMBERS   
    public function getMembers($id)
    {
        return $this->repository->skipPresenter()->find($id)->members;
    }

    public function getMember($id, $member)
    {
        return $this->repository->skipPresenter()->hasMember($member, $id);
    }

    public function newMember($id, $member)
    {
        return [$this->service->addMember($id, $member)];
    }

    public function removeMember($id, $member)
    {
        return $this->service->removeMember($id, $member);
    }

// METHODS TO RELATIONS WITH TASKS

    public function getTask($id, $task_id)
    {
        return $this->repository->getTask($id, $task_id);
    }

// METHODS TO RELATIONS WITH Files
    public function getFiles($id)
    {
        return $this->repository->skipPresenter->find($id)->files();
    }

    public function getFile($id, $task_id)
    {
        return $this->repository->getTask($id, $task_id);
    }

}
