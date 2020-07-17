<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', 'API\AuthController@login');
Route::post('register', 'API\AuthController@register');
Route::post('about\{deliverer_username}', 'API\DelivererController@about');
Route::get('all_cities', 'API\DelivereRegions@regionsWithCities');
Route::get('cities\{region}', 'API\DelivereRegions@cities');

Route::middleware('auth:api')->post('logout','API\AuthController@logout');
// Route::middleware('auth:api')->post('dashboard','API\DelivererController@dashboard');

Route::middleware('auth:api')->group(function(){
  Route::post('user_detail', 'API\AuthController@user_detail');
});
