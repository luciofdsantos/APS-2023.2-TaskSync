<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Usuario\TipoUsuario;

class RelatorioPolicy
{
    public function verRelatorio(User $user)
    {
        $usuario = $user->usuario;

        if ($usuario->tipo_usuario == TipoUsuario::ADMINISTRADOR) {
            return true;
        }

        return false;
    }
}
