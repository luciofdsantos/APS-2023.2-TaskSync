<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            // $table->string('nome', 255)->nullable(false);
            // $table->string('email', 255)->nullable(false)->unique();
            $table->string('telefone', 255)->nullable(false);
            $table->string('cpf', 255)->nullable(false)->unique();
            $table->date('data_nascimento')->nullable(false);

            $table->string('rua', 255)->nullable(false);
            $table->integer('numero')->nullable(false);
            $table->string('bairro', 255)->nullable(false);
            $table->string('cep', 255)->nullable(false);

            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
