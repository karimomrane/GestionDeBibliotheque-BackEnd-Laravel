<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\UserController;
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

Route::resource('emprunts', EmpruntController::class);
Route::post('useremprunt/{id}',[EmpruntController::class,'store1']);
Route::get('empuser/{id}', [EmpruntController::class,'index1']);
Route::resource('users', UserController::class);
Route::resource('historique', HistoriqueController::class);
Route::get('historiqueuser/{id}', [HistoriqueController::class,'index1']);
Route::middleware('auth:sanctum')->group(function () {
Route::resource('livres', LivreController::class);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('livres/search/{name}', [LivreController::class,'search']);
});
