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

Route::get('hello', function () {
    return View::make('hello');
});

Route::group(['before' => 'guest'], function () {
    Route::get('login', ['as' => 'login', 'uses' => 'authController@login']);
    Route::post('login', ['as' => 'login', 'uses' => 'authController@handleLogin']);
});

Route::group(['before' => 'Authenticate'], function () {

    //index
    Route::get('/', ['as' => 'home', function () {
        return View::make('home');
    }]);

    //Perfil de Usuario
    Route::get('user/profile', ['as' => 'user.profile', 'uses' => 'userController@profile']);
    Route::put('user/updateProfile/{id}', ['as' => 'user.updateProfile', 'uses' => 'userController@updateProfile']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'authController@logout']);
    Route::post('user/sign', ['as' => 'user.sign', 'uses' => 'userController@changeSign']);

    //Documentos
    Route::group(['before' => 'haveGroupsAcl:Documentos'], function () {
        Route::resource('document', 'documentController');
        Route::get('document/write/{id}', ['as' => 'write', 'uses' => 'documentController@writeDocument']);
        Route::get('document/{id}/workflow', ['as' => 'workflow.show', 'uses' => 'workflowController@show']);
        Route::get('document/{idDocument}/workflow/{idWorkflow}', ['as' => 'workflow.action', 'uses' => 'workflowController@action']);
        Route::get('document/{idDocument}/workflow/{idWorkflow}/edit', ['as' => 'workflow.editDocument', 'uses' => 'workflowController@editDocument']);
        Route::put('document/{idDocument}/workflow/{idWorkflow}/edit', ['as' => 'workflow.saveDocument', 'uses' => 'workflowController@saveDocument']);
        Route::post('document/{idDocument}/workflows/{idWorkflow}', ['as' => 'workflow.update', 'uses' => 'workflowController@update']);
        Route::get('document/{idDocument}/print', ['as' => 'document.print', 'uses' => 'documentController@printDocument']);
        Route::get('workflow/create', ['as' => 'workflow.create', 'uses' => 'workflowController@create']);
    });

    Route::group(['before' => 'haveGroupsAcl:Tareas'], function () {
        //Tareas
        Route::resource('task', 'taskController');
        Route::get('task/active/new', ['as' => 'taskActivation', 'uses' => 'taskController@activation']);
        Route::post('task/active/{id}', ['as' => 'taskActive', 'uses' => 'taskController@active']);
    });

    Route::group(['before' => 'haveGroupsAcl:Plantillas'], function () {
        //Plantillas
        Route::resource('template', 'templateController');
        Route::get('template/{id}/step', ['as' => 'steps', 'uses' => 'templateController@steps']);
        Route::post('template/stepSave', ['as' => 'stepsSave', 'uses' => 'templateController@stepsSave']);
        Route::get('template/active/new', ['as' => 'templateActivation', 'uses' => 'templateController@activation']);
        Route::post('template/active/{id}', ['as' => 'templateActive', 'uses' => 'templateController@active']);
    });

    Route::group(['before' => 'haveGroupsAcl:Usuarios'], function () {
        //Usuarios
        Route::get('user/desactive/{id}', ['as' => 'user.desactive', 'uses' => 'userController@desactive']);
        Route::put('user/addGroup', ['as' => 'user.addGroup', 'uses' => 'userController@addGroup']);
        Route::put('user/deleteGroup', ['as' => 'user.deleteGroup', 'uses' => 'userController@deleteGroup']);
        Route::put('user/addGroupFun', ['as' => 'user.addGroupFun', 'uses' => 'userController@addGroupFun']);
        Route::put('user/deleteGroupFun', ['as' => 'user.deleteGroupFun', 'uses' => 'userController@deleteGroupFun']);
        Route::get('user/active/new', ['as' => 'userActivation', 'uses' => 'userController@activation']);
        Route::post('user/active/{id}', ['as' => 'userActive', 'uses' => 'userController@active']);
        Route::resource('user', 'userController');
    });

    Route::group(['before' => 'haveGroupsAcl:Grupos'], function () {
        //Grupos
        Route::resource('group', 'groupController');
        Route::get('group/active/new', ['as' => 'groupActivation', 'uses' => 'groupController@activation']);
        Route::post('group/active/{id}', ['as' => 'groupActive', 'uses' => 'groupController@active']);
    });

    Route::group(['before' => 'haveGroupsAcl:Reportes'], function () {
        //Reportes
        Route::get('report', ['as' => 'report.index', 'uses' => 'reportController@index']);
        //Reportes Documentos
        Route::get('report/documents', ['as' => 'report.getDocuments', 'uses' => 'reportController@getDocuments']);
        Route::post('report/documents/result', ['as' => 'report.postDocuments', 'uses' => 'reportController@postDocuments']);
        Route::post('report/documents/result/print', ['as' => 'report.printReportDocuments', 'uses' => 'reportController@printReportDocuments']);
        //Reporte Usuario
        Route::get('report/users', ['as' => 'report.getUsers', 'uses' => 'reportController@getUsers']);
        Route::post('report/users/result', ['as' => 'report.postUsers', 'uses' => 'reportController@postUsers']);
        Route::post('report/users/result/print', ['as' => 'report.printReportUsers', 'uses' => 'reportController@printReportUsers']);
        //Reporte Tareas
        Route::get('report/tasks', ['as' => 'report.getTasks', 'uses' => 'reportController@getTasks']);
        Route::post('report/tasks/result', ['as' => 'report.postTasks', 'uses' => 'reportController@postTasks']);
        Route::post('report/tasks/result/print', ['as' => 'report.printReportTasks', 'uses' => 'reportController@printReportTasks']);
        //Reporte Tipos de Documentos
        Route::get('report/typeDocuments', ['as' => 'report.getTypeDocuments', 'uses' => 'reportController@getTypeDocuments']);
        Route::post('report/typeDocuments/result', ['as' => 'report.postTypeDocuments', 'uses' => 'reportController@postTypeDocuments']);
        Route::post('report/typeDocuments/result/print', ['as' => 'report.printReportTypeDocuments', 'uses' => 'reportController@printReportTypeDocuments']);
        //Reporte Plantilas
        Route::get('report/templates', ['as' => 'report.getTemplates', 'uses' => 'reportController@getTemplates']);
        Route::post('report/templates/result', ['as' => 'report.postTemplates', 'uses' => 'reportController@postTemplates']);
        Route::post('report/templates/result/print', ['as' => 'report.printReportTemplates', 'uses' => 'reportController@printReportTemplates']);
    });

    Route::group(['before' => 'haveGroupsAcl:Grupos Funcionales'], function () {
        //Groupacl
        Route::resource('groupacl', 'groupaclController');
        Route::get('groupacl/active/new', ['as' => 'groupacl.activation', 'uses' => 'groupaclController@activation']);
        Route::post('groupacl/active/{id}', ['as' => 'groupaclActive', 'uses' => 'groupaclController@active']);
        Route::post('groupacl/addModule', ['as' => 'groupacl.addModule', 'uses' => 'groupaclController@addModule']);
        Route::post('groupacl/deleteModule', ['as' => 'groupacl.deleteModule', 'uses' => 'groupaclController@deleteModule']);
    });

    Route::group(['before' => 'haveGroupsAcl:Tipos de Documentos'], function () {
        //Tipos de Documentos
        Route::resource('type_document', 'typeDocumentController');
        Route::get('typedocument/active/new', ['as' => 'typedocumentActivation', 'uses' => 'typeDocumentController@activation']);
        Route::post('typedocument/active/{id}', ['as' => 'typedocumentActive', 'uses' => 'typeDocumentController@active']);
    });
});
