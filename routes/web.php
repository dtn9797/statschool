<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/score-operations', 'HomeController@score_operations');
Route::post('/score-operations', 'HomeController@process_score_operations');
Route::get('/form-musician', 'ContactController@create');
Route::post('/contact', 'ContactController@store_local');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@identify_device');
    Route::get('/show-offers', 'HomeController@index');
    Route::get('/invitation-to-follow', 'HomeController@invitation_to_follow');
    Route::get('/rewards', 'HomeController@rewards');
    Route::get('/reward/{id}/claim', 'HomeController@reward_claim');
});
