<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TarefaService;

class TarefaController extends Controller
{
    protected $tarefaService;

    public function __construct(TarefaService $tarefaService)
    {
        $this->tarefaService = $tarefaService;
    }

    public function listAll()
    {
        $data = $this->tarefaService->listAll();
        return view('components.tarefa', $data);
    }


    public function criarTarefa(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string',
            'descricao' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        $this->tarefaService->criarTarefa($validatedData);

        return redirect()->route('tarefas.listAll')->with('success', 'Tarefa criada com sucesso!');
    }

public function editarTarefa(Request $request, $id)
{
    $validatedData = $request->validate([
        'titulo' => 'required|string',
        'descricao' => 'required|string',
        'categoria_id' => 'required|exists:categorias,id'
    ]);

    $this->tarefaService->editarTarefa($validatedData, $id);

    return redirect()->route('tarefas.listAll')->with('success', 'Tarefa atualizada com sucesso!');
}

    public function deletarTarefa($id)
    {
        $this->tarefaService->deletarTarefa($id);

        return redirect()->route('tarefas.listAll')->with('success', 'Tarefa deletada com sucesso!');
    }
}
