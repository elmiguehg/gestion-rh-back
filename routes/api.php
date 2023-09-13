<?php

use App\Http\Controllers\WorkerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\JobtitleController;
Use App\Http\Controllers\AuthController;
use App\Models\Category;

;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/register' , [AuthController::class, 'create']);
Route::post('auth/login' , [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::resource('workers', WorkerController::class);
    Route::resource('entities', EntityController::class);
    Route::get('workerbyentity/{entity}', [EntityController::class,'WorkerByEntity']);
    Route::get('jobtitlebyentity/{entity}', [EntityController::class, 'JobtitleByEntity']);
    Route::resource('jobtitles', JobtitleController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('auth/logout' , [AuthController::class, 'logout']);
});


