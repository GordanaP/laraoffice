<?php

/**
 * Admin
 */
Route::name('admin.')->group(function() {

    /**
     * Account
     */
    Route::get('/accounts/list', 'AccountController@accountsList')->name('accounts.list');
    Route::resource('/accounts', 'AccountController', [
        'parameters' => ['accounts' => 'userId'],
        'only' => ['index','store', 'show', 'update', 'destroy']
    ]);

    /**
     * Role
     */
    Route::delete('/roles-revoke/{userId}', 'RoleController@revoke')->name('roles.revoke');
    Route::resource('/roles', 'RoleController', [
        'only' => ['index', 'store', 'edit', 'update', 'destroy']
    ]);

    /**
     * Profile
     */
    Route::resource('/profiles', 'ProfileController', [
        'parameters' => ['profiles' => 'userId'],
        'only' => ['show', 'update', 'destroy']
    ]);

    /**
     * Avatar
     */
    Route::resource('avatars', 'AvatarController', [
        'parameters' => ['avatars' => 'userId'],
        'only' => ['show', 'update']
    ]);
});
