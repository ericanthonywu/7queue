<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login','oauthandroid@login');
Route::post('/register','oauthandroid@register');
Route::post('/logout','oauthandroid@logout');
Route::post('/token','oauthandroid@token');
Route::post('/forgotpassword','oauthandroid@forgotpassword');
Route::middleware('apicheck')->group(function (){
    Route::post('/home','apiandroid@home');
    Route::post('/nearmerchant','apiandroid@nearestmerchant');
    Route::post('/settings','apiandroid@settings');
    Route::post('/profile','apiandroid@profile');
    Route::post('/feedback','apiandroid@feedback');
});

