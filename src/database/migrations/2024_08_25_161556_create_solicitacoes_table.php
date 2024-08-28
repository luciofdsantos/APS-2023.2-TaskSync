<?php

use App\Models\Solicitacao\StatusSolicitacao;
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
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->id();
            $table->string('assunto');
            $table->text('descricao');
            $table->string('categoria');
            $table->date('prazo')->nullable();
            $table->integer('status')->default(StatusSolicitacao::PENDENTE);
            $table->foreignId('cliente_id')->references('id')->on('usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacoes');
    }
};
