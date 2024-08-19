<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaDeServicoFuncionarios extends Model
{
    use HasFactory;

    protected $table = "area_de_servico_funcionarios";

    protected $fillable = [
        'funcionario_id',
        'area_de_servico_id',
    ];
}
