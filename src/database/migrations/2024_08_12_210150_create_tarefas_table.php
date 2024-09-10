<?php

use App\Models\Tarefa\StatusTarefa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->nullable(true);
            $table->text('descricao')->nullable(false); //Reevaluate the task manager field -
            $table->date('prazo')->nullable(); // Campo opcional
            $table->integer('status')->default(StatusTarefa::A_FAZER);
            $table->integer('prioridade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarefas');
    }
};
