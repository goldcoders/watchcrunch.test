<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::get('/top-users/{postCount?}', [UserController::class, 'getTopUsers'])->name('topUsers');
Route::get('/chunk-top-users/{postCount?}/{chunkCount?}', [UserController::class, 'chunkTopUsers'])->name('topUsers');
Route::get('/queue-top-users/{postCount?}/{chunkCount?}', [UserController::class, 'queuedChunkTopUsers'])->name('queueTopUsers');
