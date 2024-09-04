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
        Schema::create('equipe_area_de_servico', function (Blueprint $table) {

            $table->id();
            $table->foreignId('equipe_id')->references('id')->on('equipe')->cascadeOnDelete();
            $table->foreignId('area_de_servico_id')->references('id')->on('area_de_servico')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipe_area_de_servico');
    }
};
