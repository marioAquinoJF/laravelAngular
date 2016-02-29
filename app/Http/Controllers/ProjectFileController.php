<?php

namespace larang\Http\Controllers;

use Illuminate\Http\Request;
use larang\Http\Controllers\Controller;
use larang\Repositories\ProjectFileRepository;
use larang\Services\ProjectFileService;

class ProjectFileController extends Controller
{

    private $repository;
    private $service;

    public function __construct(ProjectFileRepository $repository, ProjectFileService $sevice)
    {
        $this->repository = $repository;
        $this->service = $sevice;
        $this->middleware('CheckProjectPermitions', ['only' =>
            [
                'store',
                'destroy',
                'index'
            ]
                ]
        );
    }

    public function index($id)
    {
        return $this->repository->skipPresenter()->findWhere(['project_id' => $id]);
    }

    public function store($id, Request $request)
    {
        return $this->service->create(array_merge($request->all(),['project_id'=>$id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $file)
    {
        try {
            return [$this->service->deleteFile($file)];
        } catch (\Exception $e) {
            return [false];
        }
    }

}
