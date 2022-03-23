<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FirebaseController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('root');
// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('create', 'App\Http\Controllers\FirebaseController@set');
Route::get('read', 'App\Http\Controllers\FirebaseController@read');
Route::get('update', 'App\Http\Controllers\FirebaseController@update');
Route::get('delete', 'App\Http\Controllers\FirebaseController@delete');