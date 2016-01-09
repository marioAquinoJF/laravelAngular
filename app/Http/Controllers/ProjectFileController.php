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
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $name = str_replace(".$extension", '', $file->getClientOriginalName());
        $data['file'] = $file;
        $data['extension'] = $extension;
        $data['name'] = $name;
        $data['project_id'] = $request->project_id;
        $data['lable'] = $request->lable ? $request->lable : null;
        $data['description'] = $request->description ? $request->description : null;

        return $this->service->createFile($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            return [$this->service->deleteFile($id)];
    }

}
