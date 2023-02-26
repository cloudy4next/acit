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

    Route::post('/login', ['as' => 'api.login', 'uses' => 'Api\ApiAuthController@login']);
    // no need to register from api side only log in
    // Route::post('/register', ['as' => 'api.register', 'uses' => 'Api\ApiAuthController@register']);
});

Route::middleware(['middleware' => 'auth:api,'], function() {

    Route::post('/logout', ['as' => 'api.logout', 'uses' => 'Api\ApiAuthController@logout']);
});
