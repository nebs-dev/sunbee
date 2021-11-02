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


Route::group(['middleware' => 'api_key', 'namespace' => 'API'], function () {

    ############
    ### Auth ###
    ############

    Route::post('users/login', 'AuthController@login');
    Route::post('users/register', 'AuthController@register');

    #############
    ### /Auth ###
    #############

    Route::group(['middleware' => 'api_auth'], function () {


        #############
        ### Users ###
        #############

        // Get user profile
        Route::get('users', 'UsersController@getUser');

        ##############
        ### /Users ###
        ##############


        ################
        ### Stations ###
        ################

        // Get stations
        Route::get('stations', 'StationsController@getStations');

        // Get history
        Route::get('stations/history', 'StationsController@getHistory');

        // Get history with uid
        Route::get('stations/history/{uid}', 'StationsController@getHistory');

        #################
        ### /Stations ###
        #################

    });

});
