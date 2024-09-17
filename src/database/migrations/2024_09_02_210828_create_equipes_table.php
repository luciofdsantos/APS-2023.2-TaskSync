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
        Schema::create('equipe', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255)->nullable(false);
            $table->text('descricao')->nullable(false);
            $table->timestamps();
        });


        Schema::create('funcionario_equipe', function (Blueprint $table) {
            $table->foreignId('funcionario_id')->references('id')->on('usuario')->cascadeOnDelete();
            $table->foreignId('equipe_id')->references('id')->on('equipe')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionario_equipe');
        Schema::dropIfExists('equipe');
    }
};
