<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoriaService;

class CategoriaController extends Controller
{
    protected $categoriaService;

    public function __construct(CategoriaService $categoriaService)
    {
        $this->categoriaService = $categoriaService;
    }

    public function listAll()
    {
        $categorias = $this->categoriaService->listAll();
        return view('categorias.index', compact('categorias'));
    }

    public function criarCategoriaForm()
    {
        return view('categorias.create');
    }

    public function criarCategoria(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|unique:categorias',
        ]);

        $this->categoriaService->criarCategoria($validatedData);

        return redirect()->route('categorias.listAll')->with('success', 'Categoria criada com sucesso!');
    }

    public function editarCategoriaForm($id)
    {
        $categoria = $this->categoriaService->findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }

    public function editarCategoria(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|unique:categorias,nome,' . $id,
        ]);

        $this->categoriaService->editarCategoria($validatedData, $id);

        return redirect()->route('categorias.listAll')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function deletarCategoria($id)
    {
        $this->categoriaService->deletarCategoria($id);
        return redirect()->route('categorias.listAll')->with('success', 'Categoria deletada com sucesso!');
    }
}
