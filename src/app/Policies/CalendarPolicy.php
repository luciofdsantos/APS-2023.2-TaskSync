<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Usuario\TipoUsuario;

class CalendarPolicy
{
    public function alterarArea(User $user)
    {
        $usuario = $user->usuario;

        if ($usuario->tipo_usuario == TipoUsuario::ADMINISTRADOR) {
            return true;
        }
        return false;
    }
}
