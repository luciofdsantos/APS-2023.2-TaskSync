<?php

namespace App\Models\Usuario;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Usuario extends Model
{
    use HasFactory;

    protected $table = "usuario";

    protected $fillable = [
        // 'nome',
        // 'email',
        'telefone',
        'cpf',
        'data_nascimento',
        'numero',
        'bairro',
        'rua',
        'cep',
    ];

    public function users(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'id');
    }
}
