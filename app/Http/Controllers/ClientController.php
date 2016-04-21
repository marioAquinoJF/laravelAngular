<?php

namespace larang\Http\Controllers;

use Illuminate\Http\Request;
use larang\Repositories\ClientRepository;
use larang\Services\ClientService;

class ClientController extends Controller
{

    private $repository;
    private $service;

    public function __construct(ClientRepository $repository, ClientService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * 
     * @param Illuminate\Http\Request $request
     * @return type
     */
    public function index(Request $request)
    {
        $limit = $request->query->get('limit', 15);
        return $this->repository->paginate($limit);
    }

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function show($id)
    {
        return $this->repository->with('projects')->find($id);
    }

    public function update($id, Request $request)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->repository->delete($id) ? 'ok' : 'not ok';
    }

}
