<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//HOME-NON LOGGATI
Route::get('index','App\Http\Controllers\HomeController@home');
Route::get('cerca','App\Http\Controllers\HomeController@ispirati');
Route::post('search','App\Http\Controllers\HomeController@search');
Route::get('foto_all_nolog','App\Http\Controllers\HomeController@foto_all_nolog');
//_____

//ACCESSO
Route::get('login', 'App\Http\Controllers\LogController@login_view');
Route::post('login', 'App\Http\Controllers\LogController@login');
Route::get('log','App\Http\Controllers\LogController@log_view');
Route::post('log','App\Http\Controllers\LogController@log');
Route::get('logout','App\Http\Controllers\LogController@logout');
Route::get('check_username','App\Http\Controllers\LogController@check_username');
Route::get('check_email','App\Http\Controllers\LogController@check_mail');
//____

//ACCOUNT
Route::get('benvenuto','App\Http\Controllers\AccountController@benvenuto');
Route::get('account','App\Http\Controllers\AccountController@account');
Route::get('album','App\Http\Controllers\AccountController@album');
Route::get('foto','App\Http\Controllers\AccountController@foto');
Route::get('delete_foto','App\Http\Controllers\AccountController@delete_foto');
Route::get('upload','App\Http\Controllers\AccountController@upload_view');
Route::post('upload','App\Http\Controllers\AccountController@upload_foto');
Route::get('change_user','App\Http\Controllers\AccountController@change_user_view');
Route::post('change_user','App\Http\Controllers\AccountController@change_user');
Route::get('change_password','App\Http\Controllers\AccountController@change_password_view');
Route::post('change_password','App\Http\Controllers\AccountController@change_password');
Route::get('delete_account','App\Http\Controllers\AccountController@delete_account');
//____

//BACHECA
Route::get('bacheca','App\Http\Controllers\BachecaController@bacheca_view');
Route::get('best_foto','App\Http\Controllers\BachecaController@best_foto');
Route::get('foto_all','App\Http\Controllers\BachecaController@foto_all');
Route::get('foto_liked','App\Http\Controllers\BachecaController@foto_liked');
Route::get('num_like','App\Http\Controllers\BachecaController@num_like');
Route::get('unlike','App\Http\Controllers\BachecaController@unlike');
Route::get('like','App\Http\Controllers\BachecaController@like');
Route::get('comment','App\Http\Controllers\BachecaController@comment');
Route::post('insert_comment','App\Http\Controllers\BachecaController@insert_comment');
//____



 Route::get('', function () {
     return view('welcome');
 });

//Route::get('home', 'App\Http\Controllers\HomeController@home'); esempio prof


