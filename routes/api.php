<?php
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group([

    'middleware' => 'api',

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResource('employee', 'EmployeeController');
Route::apiResource('subcontractor', 'SubcontractorController');
Route::apiResource('part', 'PartController');
Route::apiResource('/product', 'ProductController');
Route::apiResource('/category', 'CategoryController');
Route::apiResource('/customer', 'CustomerController');
Route::apiResource('/supplier', 'SupplierController');
Route::apiResource('item', 'ItemController');
Route::apiResource('project', 'ProjectController');
//Issue
Route::post('issue', 'IssueController@store');
Route::get('issue', 'IssueController@indexActive');
Route::get('issueall', 'IssueController@index');
Route::get('issue/{id}', 'IssueController@show');
Route::post('issue/{id}', 'IssueController@update');
Route::delete('issue/{id}', 'IssueController@destroy');

//Issue File
Route::post('issueupload/{issue_id}/file', 'IssuefileController@store');
Route::get('issueupload/{issue_id}/file', 'IssuefileController@index');
Route::get('issuefile/{file_id}', 'IssuefileController@file');
Route::post('issuefile/{file_id}', 'IssuefileController@update');
Route::delete('issuefile/{file_id}', 'IssuefileController@destroy');

//Drawing
Route::post('drawing', 'DrawingController@store');
Route::get('drawing', 'DrawingController@index');
Route::get('drawing/{id}', 'DrawingController@show');
Route::post('drawing/fileupload', 'DrawingController@fileupload');
Route::delete('drawingfile/{id}', 'DrawingfileController@destroy');
Route::get('drawingdet/{id}', 'DrawingdetController@show');
Route::delete('drawingdet/{id}', 'DrawingdetController@destroy');
Route::post('drawingdet/update/{id}', 'DrawingdetController@update');
Route::get('drawingversion/{drawing_id}', 'DrawingController@drawingversion');
Route::get('transmittal', 'DrawingtransmittalController@index');
Route::post('transmittal', 'DrawingtransmittalController@store');
Route::get('transmittal/{id}', 'DrawingtransmittalController@show');
Route::post('transmittal/{id}', 'DrawingtransmittalController@update');
Route::post('transmittal/{id}/drawing', 'DrawingtransmittalController@drawingadd');
Route::delete('transmittal/{transmittal_id}/drawing/{drawingdet_id}', 'DrawingtransmittalController@destroydrawing');
Route::delete('transmittal/{id}', 'DrawingtransmittalController@destroy');




// RFI
Route::get('allrfi', 'InspectionController@all');
Route::get('rfi', 'InspectionController@index');
Route::delete('rfi/{id}', 'InspectionController@destroy');
Route::get('rfi/{id}', 'InspectionController@show');
Route::post('rfi/{id}', 'InspectionController@update');
Route::post('rfi', 'InspectionController@store');
Route::post('rfi/inspector/{inspection_id}/{user_id}', 'InspectionController@inspection_user');
Route::get('rfi/{id}/inspector', 'InspectionController@rfiInspector');
Route::post('saverfi/{id}', 'InspectionController@saveRfi');
Route::delete('rfi/{rfi_id}/inspector/{inspector_id}', 'InspectionController@destroyInspector');
Route::get('userrfi', 'InspectionresultController@index');
Route::get('userallrfi', 'InspectionresultController@userallrfi');

//Task
Route::get('task/{id}/pic', 'TaskPicController@show');
Route::post('task/cover/{id}', 'TaskController@uploadcover');
Route::post('uploadfp/{id}', 'TaskPicController@storefp');
Route::post('task', 'TaskController@store');
Route::post('task/hide/{id}', 'TaskController@hideTask');
Route::post('task/show/{id}', 'TaskController@showTask');
Route::get('task', 'TaskController@index');
Route::get('tasknotdone', 'TaskController@indexNotDone');
Route::get('task/{id}', 'TaskController@show');
Route::post('task/{id}', 'TaskController@update');
Route::delete('task/{id}', 'TaskController@destroy');
Route::delete('taskpicture/{id}', 'TaskPicController@destroy');


Route::get('structure/{project}', 'StructureController@index');
Route::get('structure', 'StructureController@all');
Route::post('structure/{project}', 'StructureController@store');
Route::post('structureupdate/{id}', 'StructureController@update');
Route::delete('structure/{id}', 'StructureController@destroy');
Route::get('substructure/{structure}', 'SubstructureController@index');
Route::get('substructure/{part}/{structure}', 'SubstructureController@partStructure');
Route::post('substructure/{part}/{structure}', 'SubstructureController@store');
Route::get('substructure', 'SubstructureController@all');
Route::delete('substructure/{id}', 'SubstructureController@destroy');
Route::post('substructure/{id}', 'SubstructureController@update');
Route::get('step/{part}', 'StepController@stepsbypart');
Route::post('step/file', 'StepController@storeFile');
Route::post('step', 'StepController@store');
Route::get('step', 'StepController@index');
Route::delete('step/{id}', 'StepController@destroy');
Route::get('stepid/{id}', 'StepController@show');
Route::post('stepidedit/{id}', 'StepController@update');

Route::post('/salary/paid/{id}', 'SalaryController@paid');
Route::get('/salary', 'SalaryController@allSalary');
Route::get('/salary/view/{id}', 'SalaryController@viewSalary');
Route::get('/edit/slary/{id}', 'SalaryController@editSalary');
Route::post('/salary/update/{id}', 'SalaryController@updateSalary');
Route::post('/stock/update/{id}', 'ProductController@stockUpdate');
Route::get('/getting/product/{id}', 'PosController@getProduct');

Route::get('/addtocart/{id}', 'CartController@addToCart');
Route::get('/remove/cart/{id}', 'CartController@removeCart');
Route::get('/cart/product', 'CartController@cartProduct');
Route::get('/increment/{id}', 'CartController@increment');
Route::get('/decrement/{id}', 'CartController@decrement');
Route::get('/vat', 'CartController@vat');

Route::post('/orderdone', 'PosController@orderdone');
Route::get('/orders', 'OrderController@todayOrder');
Route::post('/search/order', 'PosController@searchOrderDate');
Route::get('/order/details/{id}', 'OrderController@orderDetails');
Route::get('/order/orderdetails/{id}', 'OrderController@orderDetailsAll');
Route::get('/today/sale', 'PosController@todaySale');
Route::get('/today/income', 'PosController@todayIncome');
Route::get('/today/due', 'PosController@todayDue');
Route::get('/today/expense', 'PosController@todayExpense');
Route::get('/stockout', 'PosController@stockOut');

Route::get('/user', 'UserController@index');