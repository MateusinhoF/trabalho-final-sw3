<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateTipoDeUsuarioSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            ['tipo'=>'admin', 'created_at'=>now()],
            ['tipo'=>'comprador', 'created_at'=>now()],
            ['tipo'=>'vendedor', 'created_at'=>now()]
        ];

        DB::table('tipo_de_usuario')->insert($tipos);
    }
}
