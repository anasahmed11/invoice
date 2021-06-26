<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();
Route::namespace('Admin')->group(function(){
    Route::get('/home', 'HomeController@index')->name('dashboard');
    /* ------------- customers ---------------*/
    Route::get('/customers', 'CustomerController@index')->name('customers');
    Route::post('customers', 'CustomerController@store');
    Route::post('customers/{id}', 'CustomerController@update');
    /* ------------- users ---------------*/
    Route::get('/users', 'UserController@index')->name('users');
    Route::post('users', 'UserController@store');
    Route::post('users/{id}', 'UserController@update');
    Route::delete('users/{id}', 'UserController@destroy');
    /* ------------- invoice ---------------*/
    Route::get('/invoice-index', 'InvoiceController@index')->name('invoice-index');
    Route::get('/customer-invoice', 'InvoiceController@create')->name('customer-invoice');
    Route::post('customer-invoice', 'InvoiceController@customer_invoice');
    Route::get('/new-invoice', 'InvoiceController@create_new')->name('new-invoice');
    Route::post('new-invoice', 'InvoiceController@new_invoice');
    Route::get('/export-invoice-details/{id}', 'InvoiceController@export_invoice_pdf');
});
