<?php

namespace App\Models\Tarefa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{

    protected $fillable = [
        'nome', 'gerente_responsavel', 'email_contato', 'status', 'descricao'
    ];

}
