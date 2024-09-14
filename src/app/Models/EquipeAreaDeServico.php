<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipeAreaDeServico extends Model
{
    use HasFactory;

    protected $table = 'equipe_area_de_servico';

    protected $fillable = [
        'id',
        'equipe_id',
        'area_de_servico_id',
    ];
}
