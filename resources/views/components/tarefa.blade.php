<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .completed {
            text-decoration: line-through;
        }
    </style>
</head>

<body>
    <x-app-layout>
        <div id="myModal" class="modal hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
            <div class="modal-content bg-white rounded-lg p-8">
                <span class="close absolute top-0 right-0 cursor-pointer p-2">&times;</span>
                <h2 class="text-2xl font-bold mb-4">Adicionar Tarefa</h2>
                <form method="post" action="{{ route('tarefas.criar') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="titulo" class="block mb-2">Título:</label>
                        <input type="text" id="titulo" name="titulo" required
                            class="border border-gray-300 rounded-md p-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="descricao" class="block mb-2">Descrição:</label>
                        <textarea id="descricao" name="descricao" required class="border border-gray-300 rounded-md p-2 w-full"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="categoria" class="block mb-2">Categoria:</label>
                        <select id="categoria" name="categoria_id" required
                            class="border border-gray-300 rounded-md p-2 w-full">
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Criar
                        Tarefa</button>
                </form>
            </div>
        </div>

        <div id="editModal" class="modal hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
            <div class="modal-content bg-white rounded-lg p-8">
                <span class="close absolute top-0 right-0 cursor-pointer p-2">&times;</span>
                <h2 class="text-2xl font-bold mb-4">Editar Tarefa</h2>
                <form id="editForm" method="post" action="{{ route('tarefas.editar', ['id' => ':id']) }}">
                    @csrf 
                    @method('PATCH')
                    <div class="mb-4">
                        <label for="editTitulo" class="block mb-2">Título:</label>
                        <input type="text" id="editTitulo" name="titulo" required
                            class="border border-gray-300 rounded-md p-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="editDescricao" class="block mb-2">Descrição:</label>
                        <textarea id="editDescricao" name="descricao" required class="border border-gray-300 rounded-md p-2 w-full"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="editCategoria" class="block mb-2">Categoria:</label>
                        <select id="editCategoria" name="categoria_id" required
                            class="border border-gray-300 rounded-md p-2 w-full">
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Atualizar
                        Tarefa</button>
                </form>
            </div>
        </div>

        <div class="container mx-auto">
            <h1 class="text-3xl font-bold mb-4">Tarefas</h1>

            <button id="openModalBtn"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Adicionar Tarefa</button>

            <h2 class="text-2xl font-bold mt-8 mb-4">Tarefas Existentes:</h2>
            <ul>
                @foreach ($tarefas as $tarefa)
                    <li class="mb-2">
                        <input type="checkbox" class="mr-2">
                        <span id="titulo_{{ $tarefa->id }}">{{ $tarefa->titulo }}</span> - <span
                            id="descricao_{{ $tarefa->id }}">{{ $tarefa->descricao }}</span> (<span
                            id="categoria_{{ $tarefa->id }}"
                            data-categoria-id="{{ $tarefa->categoria_id }}">{{ $tarefa->categoria->nome }}</span>)
                        <button class="text-blue-500 hover:text-blue-700 ml-2 editBtn"
                            data-tarefa="{{ $tarefa->id }}">Editar</button>
                        <form action="{{ route('tarefas.deletar', ['id' => $tarefa->id]) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Excluir</button>
                        </form>
                    </li>
                    <hr>
                @endforeach
            </ul>
        </div>
    </x-app-layout>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('myModal');
            const editModal = document.getElementById('editModal');
            const openModalBtn = document.getElementById('openModalBtn');
            const closeModalBtn = document.querySelectorAll('.close');
            const editBtns = document.querySelectorAll('.editBtn');
            const editForm = document.getElementById('editForm');
            const editTitulo = document.getElementById('editTitulo');
            const editDescricao = document.getElementById('editDescricao');
            const editCategoria = document.getElementById('editCategoria');

            openModalBtn.addEventListener('click', function() {
                modal.classList.remove('hidden');
            });

            closeModalBtn.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    modal.classList.add('hidden');
                    editModal.classList.add('hidden');
                });
            });

            editBtns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const tarefaId = this.getAttribute('data-tarefa');
                    const tarefaTitulo = document.querySelector(`#titulo_${tarefaId}`)
                        .textContent.trim();
                    const tarefaDescricao = document.querySelector(`#descricao_${tarefaId}`)
                        .textContent.trim();
                    const tarefaCategoriaId = document.querySelector(`#categoria_${tarefaId}`)
                        .getAttribute('data-categoria-id');

                    editTitulo.value = tarefaTitulo;
                    editDescricao.value = tarefaDescricao;
                    editCategoria.value = tarefaCategoriaId;

                    const editUrl = editForm.getAttribute('action').replace(':id', tarefaId);
                    editForm.setAttribute('action', editUrl);

                    editModal.classList.remove('hidden');
                });
            });
        });
    </script>

</body>

</html>
