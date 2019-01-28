<?php

$router->get('/', function () {
    return view('welcome');
});

$router->auth();

$router->get('/home', 'HomeController@index');

Route::get('vue', function () {
    return view('vue');
});

Route::get('edit-profile', 'ProfileController@edit');
Route::put('edit-profile', 'ProfileController@update');