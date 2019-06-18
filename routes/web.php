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

Route::get('/', 'page@manager');
Route::get('/verify_email/{token}/{role}', 'auth@verify_email');
Route::post('/login','auth@login');
Route::get('/command/{command}', function ($command) {
    Artisan::call($command);
});
Route::post('/register','auth@register');
Route::get('/logout','auth@logout');
Route::middleware('globaladmincheck')->group(function (){

    Route::delete('/delete/table',"crud@delete");

    Route::view('/dashboard','page.index');

    Route::get('/chart/piechart','chart@piechart');

    Route::middleware('superadmincheck')->group(function (){
        Route::view('/admin/tambah','page.admin.tambah');
        Route::post('/action/admin','crud@tambahadmin');
        Route::post('/action/update/admin','crud@editadmin');
        Route::get('/admin/edit/{id}','page@editadmin');
        Route::view('/admin','page.admin.index');
        Route::post('/table/admin','table@admin');
        Route::post('/action/chgstadmin','crud@chgstadmin');
    });

    Route::view('/merchants','page.merchants.index');
    Route::post('/table/merchants','table@merchants');

    Route::middleware('managercheck')->group(function (){
        Route::view('/merchants/tambah','page.merchants.tambah');
        Route::get('/merchants/edit/{id}','page@editmerchants');
        Route::post('/action/merchants','crud@tambahmerchants');
        Route::post('/action/update/merchants','crud@editmerchants');
    });

    Route::view('/manager','page.manager.index');
    Route::post('/table/manager','table@manager');

    Route::view('/customers','page.customers.index');
    Route::post('/table/customers','table@customers');
    Route::middleware('managercheck')->group(function (){
        Route::view('/customers/tambah','page.customers.tambah');
        Route::get('/customers/edit/{id}','page@editcustomers');
        Route::post('/action/customers','crud@tambahcustomers');
        Route::post('/action/update/customers','crud@editcustomers');
    });

    Route::view('/banner','page.banner.index');
    Route::post('/table/banner','table@banner');
    Route::middleware('managercheck')->group(function (){
        Route::view('/banner/tambah','page.banner.tambah');
        Route::get('/banner/edit/{id}','page@editbanner');
        Route::post('/action/banner','crud@tambahbanner');
        Route::post('/action/update/banner','crud@editbanner');
    });

    Route::middleware('managercheck')->group(function () {
        Route::post('/table/kategoriproduk', 'table@kategoriproduk');
        Route::post('/action/kategoriproduk', 'crud@tambahkategoriproduk');
        Route::post('/action/update/kategoriproduk', 'crud@editkategoriproduk');
    });

    Route::view('/products','page.products.index');
    Route::post('/table/products','table@products');
    Route::middleware('managercheck')->group(function (){
        Route::get('/products/tambah','page@tambahproducts');
        Route::get('/products/edit/{id}','page@editproducts');
        Route::post('/action/products','crud@tambahproducts');
        Route::post('/action/update/products','crud@editproducts');
    });
    Route::view('/settings','page.settings.index');

    Route::post('/toggleuser','crud@toggleuser');
    Route::get('/getkategori','page@kategori');

    Route::view('/feedback','page.feedback.index');
    Route::post('/table/feedback','table@feedback');


});

