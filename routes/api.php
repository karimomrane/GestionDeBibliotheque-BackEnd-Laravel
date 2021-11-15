<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LivreController;
use App\Models\User;


use Illuminate\Http\Request;
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



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
   Route::get('livres/search/{name}', [LivreController::class,'search']);
   Route::resource('livres', LivreController::class);
   Route::post('/logout', [AuthController::class, 'logout']);
});