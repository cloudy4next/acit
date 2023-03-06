<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller\Api;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'cors'], function () {

    Route::post('login', ['as' => 'api.login', 'uses' => 'Api\ApiAuthController@login']);
    // no need to register from api side only log in
    // Route::post('/register', ['as' => 'api.register', 'uses' => 'Api\ApiAuthController@register']);
});


Route::group(['middleware' => 'auth:api','cors'], function() {
    Route::get('get-posts', ['as' => 'api.get.posts', 'uses' => 'Api\DiagnosisApiController@getPost']);
    Route::get('market-info', ['as' => 'api.market.info', 'uses' => 'Api\DiagnosisApiController@getMarketInfo']);
    Route::get('tutorial', ['as' => 'api.get.tutorial', 'uses' => 'Api\DiagnosisApiController@getTutorial']);
    Route::get('notice', ['as' => 'api.get.notice', 'uses' => 'Api\DiagnosisApiController@getNotice']);
    Route::post('diagnosis/{id}', ['as' => 'api.get.diagnosis', 'uses' => 'Api\DiagnosisApiController@getDiagnosis']);
    Route::post('diagnosis-store', ['as' => 'api.store.diagnosis', 'uses' => 'Api\DiagnosisApiController@storeDiagnosis']);

});


Route::group(['middleware' => 'auth:api,'], function() {
    Route::post('logout', ['as' => 'api.logout', 'uses' => 'Api\ApiAuthController@logout']);
});
