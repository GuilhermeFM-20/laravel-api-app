<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::prefix('users')->group(function(){
    Route::get('/', UserController::class);
    Route::post('/', [UserController::class,'store']);
    Route::put('/{id}', [UserController::class,'update']);
    Route::delete('/{id}', [UserController::class,'delete']);
});
