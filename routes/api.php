<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/
Route::namespace('Api')->group(function () {
    Route::group(['middleware' => ['cors']], function() {
        Route::get('getsettings','CommonController@getsettings');
        Route::get('getpromotions','CommonController@getpromotions');
        Route::get('getlocation','CommonController@getlocation');
        Route::post('token','CommonController@token');
        Route::post('gettransaction','CommonController@gettransaction');
        Route::get('getexclusiveoffer','CommonController@getexclusiveoffer');
    });

    /*------------- JWT TOKEN AUTHORIZED ROUTE-------------------*/
    Route::group(['middleware' => ['cors','jwt.verify']], function() {

    });
    /*-------------Without JWT TOKEN AUTHORIZED ROUTE-------------------*/
    });