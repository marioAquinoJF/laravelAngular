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
            return $this->repository->with('projects')->find($id);
        } catch (\Exception $e) {
            return [false];
        }
    }

    public function update($id, Request $request)
    {
        try {
            return ['resp'=>(string)$this->service->update($request->all(), $id)];
        } catch (\Exception $e) {
            return ['resp'=>'0'];
        }
    }

    public function destroy($id)
    {
        return $this->repository->delete($id) ? 'ok' : 'not ok';       
    }

}
