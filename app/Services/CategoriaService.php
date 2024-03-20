<?php

namespace App\Services;

use App\Repositories\CategoriaRepository;

class CategoriaService
{
    protected $categoriaRepository;

    public function __construct(CategoriaRepository $categoriaRepository)
    {
        $this->categoriaRepository = $categoriaRepository;
    }

    public function listAll()
    {
        return $this->categoriaRepository->all();
    }

    public function criarCategoria(array $data)
    {
        return $this->categoriaRepository->create($data);
    }

    public function editarCategoria(array $data, $id)
    {
        $categoria = $this->categoriaRepository->findOrFail($id);
        $categoria->update($data);
        return $categoria;
    }

    public function deletarCategoria($id)
    {
        return $this->categoriaRepository->delete($id);
    }
}
