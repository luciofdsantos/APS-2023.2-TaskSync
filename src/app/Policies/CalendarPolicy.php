<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Usuario\TipoUsuario;

class CalendarPolicy
{

    public function verCalendario(User $user)
    {
        $usuario = $user->usuario;

        if ($usuario->tipo_usuario == TipoUsuario::CLIENTE) {
            return false;
        }
        return true;
    }

    public function alterarArea(User $user)
    {
        $usuario = $user->usuario;

        if ($usuario->tipo_usuario == TipoUsuario::ADMINISTRADOR) {
            return true;
        }
        return false;
    }
}
