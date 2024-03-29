<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TarefaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/tarefas', [TarefaController::class, 'listAll'])->name('tarefas.listAll');
    Route::post('/tarefas', [TarefaController::class, 'criarTarefa'])->name('tarefas.criar');
    Route::patch('/tarefas/{id}', [TarefaController::class, 'editarTarefa'])->name('tarefas.editar'); // Rota para editar tarefas
    Route::delete('/tarefas/{id}', [TarefaController::class, 'deletarTarefa'])->name('tarefas.deletar');
});





require __DIR__.'/auth.php';
