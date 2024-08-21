<?php

namespace App\Models\Tarefa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{

    protected $fillable = [
        'titulo', 'descricao', 'deadline'
    ];

}
