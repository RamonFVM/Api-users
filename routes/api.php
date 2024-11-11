<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

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


Route::post('/login', [UsuarioController::class, 'login'])->name('login');
Route::post('/cadastro',[UsuarioController::class,'cadastro'])->middleware('throttle:20,1');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user(); 
});
