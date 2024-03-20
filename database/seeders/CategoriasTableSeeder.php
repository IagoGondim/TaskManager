<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
            'nome' => 'Pessoal',
        ]);
        Categoria::create([
            'nome' => 'Estudo',
        ]);
        Categoria::create([
            'nome' => 'Trabalho',
        ]);
        Categoria::create([
            'nome' => 'Compras',
        ]);
        Categoria::create([
            'nome' => 'Projetos',
        ]);
        Categoria::create([
            'nome' => 'Eventos',
        ]);
        Categoria::create([
            'nome' => 'Outros',
        ]);
        
    }
}
