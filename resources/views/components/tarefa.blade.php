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
                    @csrf <!-- Proteção contra CSRF -->
                    <div class="mb-4">
                        <label for="titulo" class="block mb-2">Título:</label>
                        <input type="text" id="titulo" name="titulo" required class="border border-gray-300 rounded-md p-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="descricao" class="block mb-2">Descrição:</label>
                        <textarea id="descricao" name="descricao" required class="border border-gray-300 rounded-md p-2 w-full"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="categoria" class="block mb-2">Categoria:</label>
                        <select id="categoria" name="categoria_id" required class="border border-gray-300 rounded-md p-2 w-full">
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Criar Tarefa</button>
                </form>
            </div>
        </div>

        <div class="container mx-auto">
            <h1 class="text-3xl font-bold mb-4">Tarefas</h1>

            <button id="openModalBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Adicionar Tarefa</button>

            <h2 class="text-2xl font-bold mt-8 mb-4">Tarefas Existentes:</h2>
            <ul>
@foreach ($tarefas as $tarefa)
    <li class="mb-2">
        <input type="checkbox" class="mr-2" >
        {{ $tarefa->titulo }} - {{ $tarefa->descricao }} ({{ $tarefa->categoria->nome }})
        <form action="{{ route('tarefas.deletar', ['id' => $tarefa->id]) }}" method="POST" style="display: inline;">
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
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('myModal');
            const openModalBtn = document.getElementById('openModalBtn');
            const closeModalBtn = document.querySelector('.close');

            openModalBtn.addEventListener('click', function () {
                modal.classList.remove('hidden');
            });

            closeModalBtn.addEventListener('click', function () {
                modal.classList.add('hidden');
            });

            window.addEventListener('click', function (event) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });

            const checkboxes = document.querySelectorAll('input[type="checkbox"]');

            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    const listItem = this.parentNode;
                    if (this.checked) {
                        listItem.classList.add('completed');
                        const hr = document.createElement('hr');
                        listItem.parentNode.insertBefore(hr, listItem.nextSibling);
                    } else {
                        listItem.classList.remove('completed');
                        const hr = listItem.nextSibling;
                        if (hr.tagName === 'HR') {
                            hr.parentNode.removeChild(hr);
                        }
                    }
                });
            });
        });

        // Função para deletar uma tarefa
        function deletarTarefa(id) {
            if (confirm('Tem certeza que deseja excluir esta tarefa?')) {
                fetch(`/tarefas/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        console.log('Tarefa excluída com sucesso.');
                        window.location.reload();
                    } else {
                        console.error('Erro ao excluir tarefa.');
                    }
                })
                .catch(error => {
                    console.error('Erro ao excluir tarefa:', error);
                });
            }
        }
    </script>

</body>
</html>

