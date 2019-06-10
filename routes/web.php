<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'login');
Route::post('/login','auth@login');
Route::get('/logout','auth@logout');
Route::middleware('globaladmincheck')->group(function (){
    Route::delete('/delete/table',"crud@delete");

    Route::view('/dashboard','page.index');

    Route::middleware('superadmincheck')->group(function (){
        Route::view('/admin/tambah','page.admin.tambah');
        Route::post('/action/admin','crud@tambahadmin');
        Route::post('/action/update/admin','crud@editadmin');
        Route::get('/admin/edit/{id}','page@editadmin');
    });

    Route::view('/admin','page.admin.index');
    Route::post('/table/admin','table@admin');

    Route::view('/manager','page.manager.index');
    Route::post('/table/manager','table@manager');

    Route::view('/customers','page.customers.index');
    Route::post('/table/customers','table@customers');

    Route::view('/merchants','page.merchants.index');
    Route::view('/merchants/tambah','page.merchants.tambah');
    Route::get('/merchants/edit/{id}','page@editmerchants');
    Route::post('/table/merchants','table@merchants');
});

