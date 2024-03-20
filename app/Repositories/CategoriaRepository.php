<?php

namespace App\Repositories;

use App\Models\Categoria;

class CategoriaRepository
{
    public function all()
    {
        return Categoria::all();
    }

    public function create(array $data)
    {
        return Categoria::create($data);
    }

    public function findOrFail($id)
    {
        return Categoria::findOrFail($id);
    }

    public function delete($id)
    {
        return Categoria::findOrFail($id)->delete();
    }
}
