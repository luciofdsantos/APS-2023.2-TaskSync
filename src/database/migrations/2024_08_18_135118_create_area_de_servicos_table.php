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
        Schema::create('area_de_servico',    function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255)->nullable(false);

            $table->foreignId('gerente_id')->nullable(false)->references('id')->on('usuario');
            $table->timestamps();
        });

        Schema::create('area_de_servico_tarefas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tarefa_id')->references('id')->on('tarefas');
            $table->foreignId('area_de_servico_id')->references('id')->on('area_de_servico')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('area_de_servico_funcionarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funcionario_id')->references('id')->on('usuario');
            $table->foreignId('area_de_servico_id')->references('id')->on('area_de_servico')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_de_servico_tarefas');
        Schema::dropIfExists('area_de_servico_funcionarios');
        Schema::dropIfExists('area_de_servico');
    }
};
