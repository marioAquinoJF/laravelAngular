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
        $this->middleware('check.project.owner', [
            'only' =>
            [
                'destroy'
            ]
        ]);
    }

    public function index()
    {
        return $this->repository->findWithOwnerAndMember(\Authorizer::getResourceOwnerId());
    }

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id)
    {
        return $this->repository->find($id);
    }

    public function update($id, Request $request)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->delete($id) ? ['message' => 'Excluído com sucesso!'] : ['message' => 'Não foi possível excluir o projeto!'];
    }

}
