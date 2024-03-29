<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

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
    return view('grid');
});

Route::get('/create', function () {
    return view('create');
});

Route::get('/update/{id}', function (int $id) {
    $user = User::find($id);
    return view('update',['user' => $user]);
});
