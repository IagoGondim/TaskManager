<?php

namespace App\Repositories;

use App\Models\Tarefa;

class TarefaRepository
{
    public function all()
    {
        return Tarefa::all();
    }

    public function create(array $data)
    {
        return Tarefa::create($data);
    }

    public function findOrFail($id)
    {
        return Tarefa::findOrFail($id);
    }

    public function delete($id)
    {
        return Tarefa::findOrFail($id)->delete();
    }
}
