<?php

namespace larang\Http\Controllers;

use larang\Http\Controllers\Controller;
use larang\Repositories\ProjectMemberRepository;

class ProjectMemberController extends Controller
{

    private $repository;

    public function __construct(ProjectMemberRepository $repository)
    {
        $this->repository = $repository;

        $this->middleware('CheckProjectPermitions', ['only' =>
            [

                'show'
            ]
                ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $memberId)
    {
        return $this->repository->getMember($id, $memberId);
    }

}
