<?php


Route::group(['namespace'=>'admin'],function (){
    Route::any('/', 'DashboardController@login')->name('login');
    Route::any('signup', 'UserController@signup')->name('signup');
    Route::any('login_action', 'UserController@login_action')->name('login_action');
});


Route::group(['namespace' => "admin",'middleware'=>'auth'], function () {
    Route::any('admin', 'DashboardController@admin')->name('admin');


    Route::group(['prefix'=>'users','middleware'=>'admin'],function (){
        Route::any('/','UserController@users')->name('users');
        Route::any('user_delete/{uid?}','UserController@user_delete')->name('user_delete');
        Route::any('user_search','UserController@user_search')->name('user_search');
        Route::any('edit_user/{uid?}','UserController@edit_user')->name('edit_user');
        Route::any('edit_user_action','UserController@edit_user_action')->name('edit_user_action');
        Route::any('update_status','UserController@update_status')->name('update_status');


    });

    Route::any('logout', 'UserController@logout')->name('logout');

});