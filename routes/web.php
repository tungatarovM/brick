<?php

use Illuminate\Support\Facades\Route;

// Auth not required
Route::get('/', 'Home\Web\HomeController@index')->name('home');
Route::get('/current-user', 'Account\Web\AccountController@currentUser');

Auth::routes();
