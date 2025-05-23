<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/signup', 'App\Http\Controllers\AuthController@register');
Route::post('/signin', 'App\Http\Controllers\AuthController@login');
Route::post('/signout', 'App\Http\Controllers\AuthController@logout');