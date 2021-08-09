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
    return view('welcome');
});

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

route::get('/fillable',[App\Http\Controllers\CrudController::class,'getoffers']);
Route::group(['prefix'=>'offers'],function(){
    //route::get('/store',[App\Http\Controllers\CrudController::class,'store']);

    route::get('/create',[App\Http\Controllers\CrudController::class,'create']);
    route::post('/store',[App\Http\Controllers\CrudController::class,'store'])->name('offers.store');
});



