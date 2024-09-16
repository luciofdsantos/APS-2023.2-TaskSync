<?php

namespace App\Models\Tarefa;

use App\Models\Usuario\Usuario;
use App\Models\Nota;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tarefa extends Model
{

    protected $fillable = [
        'titulo',
        'descricao',
        'prazo',
        'prioridade',
        'data_conclusao',
    ];

    public function funcionarios(): BelongsToMany
    {
        return $this->belongsToMany(
            Usuario::class,
            'tarefa_usuarios',
            'tarefa_id',
            'usuario_id',
        );
    }


    public function notas()
    {
        return $this->hasMany(Nota::class, 'tarefa_id');
    }
}
