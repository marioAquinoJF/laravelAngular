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
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return $this->repository->getFullProject($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $this->service->update($request->all(), $request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return [$this->service->delete($request->id)];
    }

    // METHODS TO RELATIONS WITH MEMBERS   
    public function getMembers($id)
    {
        return $this->repository->find($id)['data']['members'];
    }

    public function getMember($project_id, $member_id)
    {
        return $this->repository->hasMember($member_id, $project_id);
    }

    public function newMember(Request $request)
    {
        return [$this->service->addMember($request->id, $request->member_id)];
    }

    public function removeMember(Request $request)
    {
        return $this->service->removeMember($request->id, $request->member_Id);
    }

    public function isMember($project_id, $user_id)
    {
        $member = $this->repository->hasMember($user_id, $project_id);
        if (is_array($member)) {
            return count($member) === 0 ? false : $member;
        }
        return false;
    }

    // METHODS TO RELATIONS WITH TASKS
    public function getTasks($id)
    {
        return $this->repository->find($id)['data']['tasks'];
    }

    public function getTask($id, $task_id)
    {
        return $this->repository->getTask($id, $task_id);
    }

    // METHODS TO RELATIONS WITH Files
    public function getFiles($id)
    {
        return $this->repository->find($id)['data']['files'];
    }

    public function getFile($id, $task_id)
    {
        return $this->repository->getTask($id, $task_id);
    }

}
