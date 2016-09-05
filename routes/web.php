<?php

use App\User;
use Illuminate\Support\Facades\Input;

Route::get('/', function () {
    return view('welcome');
});

Route::post('api/v1/login', function () {
    $input = Input::json();
        
    $email = $input->get('email');
    $password = $input->get('password');

    $user = User::where('email', $email)->where('password', md5($password))->first();
       
    if (is_null($user)) {
        return response()->json(array("error" => "invalid credentials"), 401);
    }
        
    return response()->json(array(
        "user_id" => $user->id,
        "api_token" => $user->api_token
    ));

})->middleware('web');

Route::get('api/v1/jokes', 'JokeController@index')->middleware('auth:api');
