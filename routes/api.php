<?php

use Illuminate\Http\Request;


Route::group([

    'middleware' => ['api', 'header'],

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('invited/register', 'AuthController@invitedRegister');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('user', 'AuthController@me');
    Route::get('check/token', 'AuthController@checkToken');

    Route::get('verify/{token}', 'AuthController@verify')->name('verify');
    Route::get('mail/{user}/resend', 'AuthController@resend');

    Route::get('verified/user', 'AuthController@getVerifiedUsers');

    Route::post('invite', 'InviteController@send')->name('process');
    Route::get('accept/{token}', 'InviteController@accept')->name('accept');

    Route::get('my/bills', 'BillController@get')->name('bill');
    Route::post('create/bill', 'BillController@store')->name('bill');


    Route::group(['prefix' => 'admin', 'namespace'=>'Admin'], function (){

        Route::get('all/bills', 'BillController@index');
        Route::delete('bill/delete/{bill}', 'BillController@delete');

        Route::get('all/users', 'UsersController@index');


    });

    Route::post('pay/debt', 'TransferController@PayDebt')->name('payDebt');


});