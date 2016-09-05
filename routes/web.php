<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('api/v1/jokes', 'JokeController@index')->middleware('auth:api');
