<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('/login');
});

Auth::routes();

Route::get('/home', 'Home\Web\HomeController@index')->name('home');
