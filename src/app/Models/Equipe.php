<?php

namespace App\Models;

use App\Models\Usuario\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Equipe extends Model
{
    use HasFactory;

    protected $table = "equipe";

    protected $fillable = [
        'id',
        'nome',
        'descricao',
    ];

    public function funcionarios(): BelongsToMany
    {
        return $this->belongsToMany(
            Usuario::class,
            'funcionario_equipe',
            'equipe_id',
            'funcionario_id'
        );
    }
}
