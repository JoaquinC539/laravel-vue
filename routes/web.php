<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\UserTController;
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


Route::get("/",[HomeController::class,'welcome'] );
// Route::get("resource/{pathFile}",[ResourceController::class,"resource"])->where('pathFile','.*');
// Route::get("publics/{pathFile}",[ResourceController::class,"publics"])->where('pathFile','.*');;
Route::get("path",[ResourceController::class,"getPath"]);
Route::resource("user",UserTController::class);

