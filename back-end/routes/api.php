<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//I know that here should be used PATCH or PUT method, but my NGINX
//denied to process such requests and I had no time to resolve this problem,
//that's why realized it like this, considering that you  are more interested in my programming skills, then devops
Route::post('branch/update', 'BranchController@update');

Route::get('branch/list/{parentBranchId?}', 'BranchController@list');

Route::post('branch/store', 'BranchController@store');

Route::delete('branch/{branch}', 'BranchController@destroy');
