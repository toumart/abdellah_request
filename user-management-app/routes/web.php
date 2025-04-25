<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



Route::get('/', [UserController::class, 'index']);
Route::post('/register', [UserController::class, 'store']);
Route::get('/search', [UserController::class, 'search']);
Route::post('/import', [UserController::class, 'import']);
Route::get('/export', [UserController::class, 'export']);
Route::get('/live-search', [UserController::class, 'liveSearch']);



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
