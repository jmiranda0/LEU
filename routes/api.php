<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Endpoint para listar y filtrar usuarios
// Ejemplos de uso:
// GET /api/users
// GET /api/users?page=2
// GET /api/users?role=manager
Route::get('/users', [UserController::class, 'index']);

// Endpoint para obtener estadísticas de usuarios por rol
// GET /api/users/statistics
Route::get('/users/statistics', [UserController::class, 'statistics']);