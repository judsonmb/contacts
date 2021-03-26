<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    if(Auth::check()){
        return redirect('/home');
    }
    return view('auth.login');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    Route::get('/home', [App\Http\Controllers\PersonController::class,'index']);
    Route::resource('people', 'App\Http\Controllers\PersonController');
    Route::resource('contact', 'App\Http\Controllers\ContactController');

});