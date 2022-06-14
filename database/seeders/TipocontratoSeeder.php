<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipocontratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tipo_contratos')->insert([
            'nombre' => 'OPS'
        ]);

        DB::table('tipo_contratos')->insert([
            'nombre' => 'Labor'
        ]);

        DB::table('tipo_contratos')->insert([
            'nombre' => 'Termino fijo'
        ]);

        DB::table('tipo_contratos')->insert([
            'nombre' => 'Termino indefinido'
        ]);

        DB::table('tipo_contratos')->insert([
            'nombre' => 'Aprendizaje'
        ]);

        DB::table('tipo_contratos')->insert([
            'nombre' => 'Ocacional'
        ]);

        DB::table('tipo_contratos')->insert([
            'nombre' => 'Accidental'
        ]);
    }
}
