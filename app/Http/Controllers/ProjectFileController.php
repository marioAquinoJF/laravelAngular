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

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $data['file'] = $file;
        $data['extension'] = $extension;
        $data['name'] = $request->name . ".$extension";
        $data['project_id'] = $id;
        $data['lable'] = $request->lable ? $request->lable : null;
        $data['description'] = $request->description ? $request->description : null;

        return $this->service->createFile($data);
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
