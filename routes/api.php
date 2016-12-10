<?php

use Illuminate\Http\Request;

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
$this->group(['middleware' => ['api','cors']], function () {
	$this->post('/login', 'Api\ApiAuthController@login')->middleware('api');
});


$this->group(['middleware' => ['auth:api','cors']], function () {

	/*
	*	Api route on /test
	*/
	$this->post('/test', 'Api\TestController@test');
});
