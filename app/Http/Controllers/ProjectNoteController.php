<?php

namespace larang\Http\Controllers;

use Illuminate\Http\Request;
use larang\Repositories\ProjectNoteRepository;
use larang\Services\ProjectNoteService;

class ProjectNoteController extends Controller
{

    private $repository;
    private $service;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $sevice)
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
                'index',
                'store',
                'getTasks',
                'show',
                'update',
            ]
                ]
        );
    }


    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
    }

    public function store($project_id, Request $request)
    {
        return $this->service->create(array_merge($request->all(), ['project_id' => $project_id]));
    }

    public function show($id, $note)
    {
        return $this->repository->findWhere(['project_id' => $id, 'id' => $noteId]);
    }

    public function update($project_id, $note, Request $request)
    {
        return $this->service->update(array_merge($request->all(), ['project_id' => $project_id]), $note);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($this->repository->exists($request->note)) {
            return [$this->repository->delete($request->note)];
        }
        return [false];
    }

}
