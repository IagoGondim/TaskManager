<?php

namespace App\Services;

use App\Repositories\TarefaRepository;
use App\Models\Categoria;


class TarefaService
{
    protected $tarefaRepository;

    public function __construct(TarefaRepository $tarefaRepository)
    {
        $this->tarefaRepository = $tarefaRepository;
    }

    public function listAll()
    {
        return [
            'tarefas' => $this->tarefaRepository->all(),
            'categorias' => Categoria::all() 
        ];
    }

    public function criarTarefa(array $data)
    {
        return $this->tarefaRepository->create($data);
    }

public function editarTarefa(array $data, $id)
{
    $tarefa = $this->tarefaRepository->findOrFail($id);
    $tarefa->update($data);
    return $tarefa;
}


    public function deletarTarefa($id)
    {
        return $this->tarefaRepository->delete($id);
    }
}
