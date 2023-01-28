<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\PageController;

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

Route::get('/',[HomeController::class,'index'])->name('home');
Route::post('/register',[HomeController::class,'register'])->name('register');

Route::get('/page_a/{key}',[PageController::class,'pageA'])->name('pageA');
Route::get('/page_a/{key}/delete',[PageController::class,'deleteKey'])->name('deleteKey');
Route::get('/page_a/{user}/create_now',[PageController::class,'createKey'])->name('createKey');

Route::get('/user/{user}/Imfeelinglucky',[PageController::class,'Imfeelinglucky'])->name('Imfeelinglucky');
Route::get('/user/{user}/Imfeelinglucky/info',[PageController::class,'ImfeelingluckyInfo'])->name('ImfeelingluckyInfo');





