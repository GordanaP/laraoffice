<?php

Route::get('/test', function(){
    return view('test')->with([
        'roles' => \App\Role::all()
    ]);
});

/**
 * Auth
 */
Auth::routes();

/**
 * Page
 */
Route::get('/', 'PageController@index')->name('index');
Route::get('/home', 'PageController@home')->name('home');
Route::get('admin/dashboard', 'PageController@dashboard')->name('admin.dashboard');
Route::get('admin/settings', 'PageController@settings')->name('admin.settings');