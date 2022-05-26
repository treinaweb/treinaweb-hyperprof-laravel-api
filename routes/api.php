<?php

use App\Http\Controllers\AutenticacaoController;
use App\Http\Controllers\CadastrarAluno;
use App\Http\Controllers\EnviarFotoUsuario;
use App\Http\Controllers\ListarAlunos;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;


Route::get('professores', [UsuarioController::class, 'index']);
Route::post('professores', [UsuarioController::class, 'store']);

Route::post('auth/login', [AutenticacaoController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::put('professores', [UsuarioController::class, 'update']);
    Route::delete('professores', [UsuarioController::class, 'destroy']);

    Route::get('professores/alunos', ListarAlunos::class);

    Route::post('professores/{user}/foto', EnviarFotoUsuario::class);

    Route::delete('auth/logout', [AutenticacaoController::class, 'logout']);
});

Route::post('professores/{user}/alunos', CadastrarAluno::class);
Route::get('professores/{user}', [UsuarioController::class, 'show']);