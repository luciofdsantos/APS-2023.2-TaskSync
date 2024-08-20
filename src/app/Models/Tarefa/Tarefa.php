<?php

namespace App\Models\Tarefa;

use App\Models\Usuario\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tarefa extends Model
{

    protected $fillable = [
        'nome',
        'gerente_responsavel',
        'email_contato',
        'status',
        'descricao'
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
}
