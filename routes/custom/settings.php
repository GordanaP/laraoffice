<?php

// USER SETTINGS

Route::name('users.')->group(function() {

    /**
     * Account
     */
    Route::get('/myaccount', 'AccountController@edit')->name('accounts.edit');
    Route::put('/myaccount', 'AccountController@update')->name('accounts.update');
    Route::delete('/myaccount', 'AccountController@destroy')->name('accounts.destroy');

    /**
     * Profile
     */
    Route::get('/myprofile', 'ProfileController@edit')->name('profiles.edit');
    Route::put('/myprofile', 'ProfileController@update')->name('profiles.update');
    Route::delete('/myprofile', 'ProfileController@destroy')->name('profiles.destroy');

    /**
     * Avatar
     */
    Route::get('/myavatar', 'AvatarController@edit')->name('avatars.edit');
    Route::put('/myavatar', 'AvatarController@update')->name('avatars.update');

});