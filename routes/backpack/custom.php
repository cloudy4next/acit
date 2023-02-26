<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('category', 'CategoryCrudController');
    Route::crud('post', 'PostCrudController');
    Route::crud('tutorial', 'TutorialCrudController');
    Route::crud('notice', 'NoticeCrudController');


    Route::get('post/{id}/edit', ['as' => 'admin.post.edit', 'uses' => 'PostCrudController@edit']);
    Route::post('post/store', ['as' => 'admin.post.store', 'uses' => 'PostCrudController@store']);

    Route::post('post/{id}/update', ['as' => 'admin.post.update', 'uses' => 'PostCrudController@update']);


    Route::get('farmer/{id}/edit', ['as' => 'admin.farmer.edit', 'uses' => 'farmerController@edit']);
    Route::get('farmer/store', ['as' => 'admin.farmer.store', 'uses' => 'farmerController@store']);
    Route::get('farmer/{id}/update', ['as' => 'admin.farmer.update', 'uses' => 'farmerController@update']);


    // Route::get('farmer', ['as' => 'admin.farmer', 'uses' => 'FarmerController@index']);
    // Route::get('farmer-search', ['as' => 'admin.farmer.search', 'uses' => 'FarmerController@search']);
    // Route::get('user-name', ['as' => 'admin.farmer.name', 'uses' => 'FarmerController@getUserName']);
    // Route::post('farmer-store', ['as' => 'admin.farmer.store', 'uses' => 'FarmerController@getUserName']);
    // Route::post('farmer/delete/{id}', ['as' => 'admin.farmer.delete', 'uses' => 'FarmerController@deleteFarmer']);

    Route::crud('farmer', 'FarmerCrudController');
    Route::crud('market-price', 'MarketPriceCrudController');
    Route::crud('stakeholder', 'StakeholderCrudController');
    Route::crud('diagnosis', 'DiagnosisCrudController');
    Route::crud('message', 'MessageCrudController');
}); // this should be the absolute last line of this file