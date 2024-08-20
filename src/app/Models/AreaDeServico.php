<?php

namespace App\Models;

use App\Models\Tarefa\Tarefa;
use App\Models\Usuario\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class AreaDeServico extends Model
{
    use HasFactory;

    protected $table = 'area_de_servico';

    protected $fillable = [
        'nome',
        'gerente_id',
    ];

    public function gerente(): HasOne
    {
        return $this->hasOne(Usuario::class, 'id', 'gerente_id');
    }

    public function funcionarios(): BelongsToMany
    {
        return $this->belongsToMany(
            Usuario::class,
            'area_de_servico_funcionarios',
            'area_de_servico_id',
            'funcionario_id'
        );
    }

    public function tarefas(): BelongsToMany
    {
        return $this->belongsToMany(
            Tarefa::class,
            'area_de_servico_tarefas',
            'area_de_servico_id',
            'tarefa_id',
        );
    }

    public function servicoTarefas(): HasMany
    {
        return $this->hasMany(AreaDeServicoFuncionarios::class);
    }
}
