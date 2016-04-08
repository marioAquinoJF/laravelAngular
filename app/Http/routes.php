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

    Route::resource('project', 'ProjectController', ['except' => ['edit', 'create']]);
    Route::resource('client', 'ClientController', ['except' => ['edit', 'create']]);
    Route::resource('project.member', 'ProjectMemberController', ['except' => ['edit', 'create', 'update']]);
    Route::group(['middleware' => 'check.project.permitions', 'prefix' => 'project'], function() {

        Route::resource('{project}/note', 'ProjectNoteController', ['except' => ['edit', 'create']]);
        Route::resource('{project}/task', 'ProjectTaskController', ['except' => ['edit', 'create']]);
        Route::resource('{project}/file', 'ProjectFileController', ['except' => ['edit', 'create']]);
        Route::get('{project}/file/{file}/download', 'ProjectFileController@showFile');
        
    });
    Route::get('user/authenticated', 'UserController@authenticatedUser');
    Route::resource('user', 'UserController', ['except' => ['edit', 'create']]);
});
