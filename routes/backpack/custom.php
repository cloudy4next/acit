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


    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@dashboard']);

    Route::group(['middleware' => 'acl:Post'], function () {
        Route::crud('post', 'PostCrudController');
        Route::get('post/{id}/edit', ['as' => 'admin.post.edit', 'uses' => 'PostCrudController@edit']);
        Route::post('post/store', ['as' => 'admin.post.store', 'uses' => 'PostCrudController@store']);
        Route::post('post/{id}/update', ['as' => 'admin.post.update', 'uses' => 'PostCrudController@update']);
    });

    Route::group(['middleware' => 'acl:Settings'], function () {
        Route::crud('category', 'CategoryCrudController');

    });
    Route::group(['middleware' => 'acl:Tutorial'], function () {
        Route::crud('tutorial', 'TutorialCrudController');

    });
        Route::group(['middleware' => 'acl:Notice'], function () {
            Route::crud('notice', 'NoticeCrudController');

    });
        Route::group(['middleware' => 'acl:Diagnosis'], function () {
            Route::crud('diagnosis', 'DiagnosisCrudController');
            Route::get('diagnosis/{id}/reply-message', ['as' => 'admin.diagnosis.edit.message', 'uses' => 'DiagnosisCrudController@messageData']);
            Route::post('diagnosis/{id}/message-update', ['as' => 'admin.diagnosis.update', 'uses' => 'DiagnosisCrudController@replyMessage']);

    });
        Route::group(['middleware' => 'acl:Farmer'], function () {

        Route::crud('farmer', 'FarmerCrudController');
        Route::post('/farmer-store', ['as' => 'admin.farmer.store', 'uses' => 'FarmerCrudController@store']);

    });
        Route::group(['middleware' => 'acl:Market'], function () {
                Route::crud('market-price', 'MarketPriceCrudController');
    });
        Route::group(['middleware' => 'acl:StakeHolder'], function () {
                Route::crud('stakeholder', 'StakeholderCrudController');

    });

    Route::get('bulk-sms', ['as' => 'admin.bulk.sms', 'uses' => 'FarmerController@bulkShow']);
    Route::post('bulk-sms', ['as' => 'admin.bulk-sms.send', 'uses' => 'FarmerController@sendBulk']);

    // Route::get('farmer/{id}/edit', ['as' => 'admin.farmer.edit', 'uses' => 'farmerController@edit']);
    // Route::get('farmer/store', ['as' => 'admin.farmer.store', 'uses' => 'farmerController@store']);
    // Route::get('farmer/{id}/update', ['as' => 'admin.farmer.update', 'uses' => 'farmerController@update']);


    // Route::get('diagnosis/{id}/reply-message', ['as' => 'admin.diagnosis.edit.message', 'uses' => 'DiagnosisCrudController@messageData']);

    // Route::get('farmer-search', ['as' => 'admin.farmer.search', 'uses' => 'FarmerController@search']);
    // Route::get('user-name', ['as' => 'admin.farmer.name', 'uses' => 'FarmerController@getUserName']);
    // Route::post('farmer-store', ['as' => 'admin.farmer.store', 'uses' => 'FarmerController@getUserName']);
    // Route::post('farmer/delete/{id}', ['as' => 'admin.farmer.delete', 'uses' => 'FarmerController@deleteFarmer']);

    Route::crud('staticpage', 'StaticPageCrudController');
}); // this should be the absolute last line of this file