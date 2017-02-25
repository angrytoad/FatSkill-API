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

// Requests to /api/
$this->group(['middleware' => ['api']], function () {
	$this->post('/login', 'Api\ApiAuthController@login')->middleware('api');
	$this->post('/register', 'Api\ApiAuthController@register');
	$this->post('/register/activate', 'Api\ApiAuthController@activate');
});


$this->group(['middleware' => ['auth:api']], function () {

	/*
	*	Api route on /test
	*/
	$this->any('/test', 'Api\TestController@test');

	$this->group(['prefix' => '/user'], function () {
		$this->get('me', 'Api\UserController@me');
	});

	$this->group(['prefix' => '/fulfillment'], function () {
		$this->get('latest', 'Api\FulfillmentController@latest');
		$this->get('recent', 'Api\FulfillmentController@recent');
		$this->post('create', 'Api\FulfillmentController@create');
		
		$this->group(['prefix' => 'position'], function () {
			$this->get('{job}', 'Api\FulfillmentController@getJob');
			$this->post('{job}/link', 'Api\FulfillmentController@addCandidate');
			$this->post('{job}/create-link', 'Api\FulfillmentController@createAndAddCandidate');
		});
	});

	$this->group(['prefix' => '/candidate'], function () {
		$this->get('basic', 'Api\CandidateController@basicCandidateList');
	});

	$this->group(['prefix' => '/tests'], function () {
		$this->get('/', 'Api\TestController@listTests');
		$this->post('create', 'Api\TestController@create');
		$this->get('view/{uuid}', 'Api\TestController@view');
		
		$this->post('{uuid}/revisions/create', 'Api\RevisionController@create');
	});
});
