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
Route::get('/index', 'PagesController@index');

Route::get('/twinCity', 'PagesController@twinCity');

Route::get('/group', 'PagesController@group');
