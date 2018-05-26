<?php

/**
 * Appointment
 */
Route::name('appointments.')->group(function(){
    Route::get('/{profile}', 'AppointmentController@index')->name('index');
    Route::post('/{profile}', 'AppointmentController@store')->name('store');
    Route::get('/{profile}/create', 'AppointmentController@create')->name('create');
    Route::put('/{profile}/{appointment}', 'AppointmentController@update')->name('update');
    Route::get('/{profile}/{appointment}/edit', 'AppointmentController@edit')->name('edit');
});