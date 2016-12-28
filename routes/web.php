<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/**
Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

*/


$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...


// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');


$this->group(['middleware' => 'auth:web'], function () {
    $this->get('/', 'HomeController@index');
    
    /*
     * Register a new user from the admin panel
     */
    $this->get('/register', 'Admin\AdminCreationController@showNewAdminForm');
    $this->post('/register', 'Admin\AdminCreationController@createNewAdmin');

    /*
     *  Display the admin panel
     */
    $this->group(['prefix' => 'admin'], function () {
        $this->get('/', 'Admin\AdminPanelDisplayController@displayPanel');

        /*
         * Test Management Routes
         */
        $this->get('/tests', 'Admin\TestController@index');
        $this->get('/tests/question_types', 'Admin\QuestionTypeController@index');
        $this->get('/tests/create', 'Admin\TestController@creation_page');
        $this->post('/tests/question_types/create', 'Admin\QuestionTypeController@store');
        $this->get('/tests/question_types/{uuid}/delete', 'Admin\QuestionTypeController@delete');
    });
    
});