<?php

namespace App\Models\Solicitacao;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    use HasFactory;
    protected $fillable = ['assunto', 'descricao', 'categoria', 'prazo', 'status'];
    protected $table = 'solicitacoes';
}
