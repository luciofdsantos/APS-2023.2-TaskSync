<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // CRIAÇÃO DE USUÁRIO PADRÃO

        DB::table('usuario')->insert(
            [
                'tipo_usuario' => 3,
                'telefone' => '000',
                'cpf' => '111.111.111-11',
                'data_nascimento' => '01-01-2000',
                'rua' => 'Rua 1',
                'numero' => 0,
                'bairro' => 'Bairro',
                'cep' => '00000-000',
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'admin',
                'password' => Hash::make('123'),
                'email' => 'admin@mail.com',
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
