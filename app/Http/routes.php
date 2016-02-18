<?php

Route::get('/', 'HomeController@index');

Route::post('oauth/access_token', function () {
    return Response::json(Authorizer::issueAccessToken());
});
Route::get('home', function() {
    return redirect('/');
});
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

Route::group(['middleware' => 'oauth'], function() {
    Route::resource('client', 'ClientController', ['except' => ['edit', 'create']]);

    Route::group(['middleware' => 'CheckProjectOwner'], function() {


        Route::resource('project', 'ProjectController', ['except' => ['edit', 'create']]);

        Route::group(['prefix' => 'project'], function() {
            Route::resource('note', 'ProjectNoteController', ['except' => ['edit', 'create']]);
            Route::resource('task', 'ProjectTaskController', ['except' => ['edit', 'create']]);
            Route::resource('file', 'ProjectFileController', ['except' => ['edit', 'create']]);

            // members

            Route::post('member', "ProjectController@newMember");
            Route::get('{id}/member/list', "ProjectController@getMembers");
            Route::get('{id}/member/{menberId}', "ProjectMemberController@show");
            Route::delete('member/delete', "ProjectController@removeMember");
            Route::post('user/isMember', "ProjectController@isMember");

            //tasks
            Route::get('{id}/tasks', "ProjectController@getTasks");
            Route::get('{id}/task/{task_id}', "ProjectController@getTask");
            //files
            
        });
    });
});
