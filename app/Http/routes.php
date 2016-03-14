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
    Route::get('userloggedin', function() {
        return ['userId'=>\Authorizer::getResourceOwnerId()];
    });
    Route::resource('project', 'ProjectController', ['except' => ['edit', 'create']]);
    Route::resource('client', 'ClientController', ['except' => ['edit', 'create']]);
    Route::group(['prefix' => 'project'], function() {


        Route::resource('{project}/note', 'ProjectNoteController', ['except' => ['edit', 'create']]);
        Route::resource('{project}/task', 'ProjectTaskController', ['except' => ['edit', 'create']]);
        Route::resource('{project}/file', 'ProjectFileController', ['except' => ['edit', 'create']]);


        Route::post('{project}/member/{member}', "ProjectController@newMember");
        Route::get('{project}/member', "ProjectController@getMembers");
        Route::get('{project}/member/{member}', "ProjectController@getMember");
        Route::delete('{project}/member/{member}', "ProjectController@removeMember");
        Route::post('{project}/user/isMember', "ProjectController@isMember");
    });
});
