<?php

use App\Http\Controllers\ListaController;
use App\Http\Controllers\TareaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/listas',[ListaController::class,'index']);
Route::post('/listas', [ListaController::class, 'store']);
Route::put('/listas/{lista}', [ListaController::class, 'update']);
Route::delete('/listas/{lista}', [ListaController::class, 'destroy']);


Route::get('/lista/{lista}/tareas',[TareaController::class,'index']);
Route::get('/tareas/destacadas',[TareaController::class,'getDestacadas']);
Route::get('/tareas/{tarea}',[TareaController::class,'show']);
Route::post('/tareas', [TareaController::class, 'store']);
Route::put('/tareas/{tarea}', [TareaController::class, 'update']);
Route::delete('/tareas/{tarea}', [TareaController::class, 'destroy']);
