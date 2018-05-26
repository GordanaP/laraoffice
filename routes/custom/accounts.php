<?php

/**
 * ActivationToken
 */
Route::resource('/token','ActivationController', [
    'parameters' => ['token' => 'activationToken'],
    'only' => ['create', 'store', 'show']
]);