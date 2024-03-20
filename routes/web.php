<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaController;
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
    Route::get('/categorias', [CategoriaController::class, 'listAll'])->name('categorias.listAll');
    Route::get('/categorias/create', [CategoriaController::class, 'criarCategoriaForm'])->name('categorias.createForm');
    Route::post('/categorias', [CategoriaController::class, 'criarCategoria'])->name('categorias.criar');
    Route::get('/categorias/{id}/edit', [CategoriaController::class, 'editarCategoriaForm'])->name('categorias.editForm');
    Route::put('/categorias/{id}', [CategoriaController::class, 'editarCategoria'])->name('categorias.editar');
    Route::delete('/categorias/{id}', [CategoriaController::class, 'deletarCategoria'])->name('categorias.deletar');
});

Route::middleware('auth')->group(function () {
    Route::get('/tarefas', [TarefaController::class, 'listAll'])->name('tarefas.listAll');
    Route::post('/tarefas', [TarefaController::class, 'criarTarefa'])->name('tarefas.criar'); 
    Route::patch('/tarefas/{id}', [TarefaController::class, 'editarTarefa'])->name('tarefas.editar');
    Route::delete('/tarefas/{id}', [TarefaController::class, 'deletarTarefa'])->name('tarefas.deletar');
    Route::put('/tarefas/{id}/concluir', [TarefaController::class, 'marcarConcluida'])->name('tarefas.marcarConcluida');
});


require __DIR__.'/auth.php';
