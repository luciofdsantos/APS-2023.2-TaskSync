<?php

namespace App\Models\Usuario;

use App\Models\User;
use Database\Factories\UsuarioFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Usuario extends Model
{
    use HasFactory;

    protected $table = "usuario";

    protected $fillable = [
        'id',
        'telefone',
        'cpf',
        'data_nascimento',
        'numero',
        'bairro',
        'rua',
        'cep',
        'tipo_usuario'
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'id');
    }

    protected static function newFactory(): Factory
    {
        return UsuarioFactory::new();
    }
}
