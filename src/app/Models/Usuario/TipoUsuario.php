<?php

namespace App\Models\Usuario;

class TipoUsuario
{
    const CLIENTE = 1;
    const FUNCIONARIO = 2;
    const ADMINISTRADOR = 3;
    const GERENTE = 4;

    public static function getAll()
    {
        return [
            self::CLIENTE => 'Cliente',
            self::FUNCIONARIO => 'Funcionário',
            self::ADMINISTRADOR => 'Administrador',
            self::GERENTE => 'Gerente',
        ];
    }
}
