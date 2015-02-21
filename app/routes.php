<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('hello',function(){
   return View::make('hello');
});

Route::group(['before' => 'guest'], function() {
    Route::get('login', array('as' => 'login', 'uses' => 'authController@login'));
    Route::post('login', array('as' => 'login', 'uses' => 'authController@handleLogin'));
});

Route::group(['before' => 'Authenticate'], function () {

    //index
    Route::get('/',['as' => 'home', function(){
        return View::make('home');
    }]);

    //Documentos
    Route::resource('document','documentController');
    Route::get('document/write/{id}',['as' => 'write','uses' => 'documentController@writeDocument']);
    Route::get('document/{id}/workflow',['as' => 'workflow.show', 'uses' => 'workflowController@show']);
    Route::get('document/{idDocument}/workflow/{idWorkflow}',['as' => 'workflow.action', 'uses' => 'workflowController@action']);
    Route::post('document/{idDocument}/workflows/{idWorkflow}',['as' => 'workflow.update', 'uses' => 'workflowController@update']);
    Route::get('document/{idDocument}/print',['as' => 'document.print', 'uses' => 'documentController@printDocument']);

    //Workflows
    Route::get('workflow/create',['as' => 'workflow.create', 'uses' => 'workflowController@create']);

    //Perfil de Usuario
    Route::get('user/profile', array('as' => 'user.profile', 'uses' => 'userController@profile'));
    Route::put('user/updateProfile/{id}', array('as' => 'user.updateProfile', 'uses' => 'userController@updateProfile'));
    Route::get('logout', array('as' => 'logout', 'uses' => 'authController@logout'));
    Route::post('user/sign',['as' => 'user.sign','uses' => 'userController@changeSign']);
    Route::get('user/active/new',['as'=> 'userActivation','uses'=>'userController@activation']);
    Route::post('user/active/{id}',['as' => 'userActive','uses' => 'userController@active']);

    Route::group(['before' => 'isManagement'], function() {
        //Tipos de Documentos
        Route::resource('type_document','typeDocumentController');
        Route::get('typedocument/active/new',['as'=> 'typedocumentActivation','uses'=>'typeDocumentController@activation']);
        Route::post('typedocument/active/{id}',['as' => 'typedocumentActive','uses' => 'typeDocumentController@active']);

        //Tareas
        Route::resource('task','taskController');
        Route::get('task/active/new',['as'=> 'taskActivation','uses'=>'taskController@activation']);
        Route::post('task/active/{id}',['as' => 'taskActive','uses' => 'taskController@active']);

        //Plantillas
        Route::resource('template','templateController');
        Route::get('template/{id}/step',['as' => 'steps', 'uses' => 'templateController@steps']);
        Route::post('template/stepSave',['as' => 'stepsSave', 'uses' => 'templateController@stepsSave']);
        Route::get('template/active/new',['as'=> 'templateActivation','uses'=>'templateController@activation']);
        Route::post('template/active/{id}',['as' => 'templateActive','uses' => 'templateController@active']);



        //Usuarios
        Route::get('user/desactive/{id}',array('as' => 'user.desactive', 'uses' => 'userController@desactive'));
        Route::put('user/addGroup',array('as' => 'user.addGroup', 'uses' => 'userController@addGroup'));
        Route::put('user/deleteGroup',array('as' => 'user.deleteGroup', 'uses' => 'userController@deleteGroup'));
        Route::resource('user', 'userController');

        //Grupos
        Route::resource('group', 'groupController');
        Route::get('group/active/new',['as'=> 'groupActivation','uses'=>'groupController@activation']);
        Route::post('group/active/{id}',['as' => 'groupActive','uses' => 'groupController@active']);

        //Reportes
        Route::get('report',array('as' => 'report.index', 'uses' => 'reportController@index'));
        Route::get('report/documents',array('as' => 'report.getDocuments', 'uses' => 'reportController@getDocuments'));
        Route::post('report/documents/result',array('as' => 'report.postDocuments', 'uses' => 'reportController@postDocuments'));
        Route::post('report/documents/result/print',array('as' => 'report.printReportDocuments', 'uses' => 'reportController@printReportDocuments'));



    });


});


