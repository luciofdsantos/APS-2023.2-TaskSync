<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tarefa_id');           
            $table->text('description');
            $table->timestamps();

            $table->foreign('tarefa_id')->references('id')->on('tarefas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notas');
    }
};
