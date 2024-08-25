<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Usuario;
use App\Models\Usuario\TipoUsuario;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\RedirectResponse;

class UsuarioPolicy
{
    /**
     * Permissão index
     */
    public function usuarios(User $user): bool|RedirectResponse
    {
        $usuario = $user->usuario;

        if ($usuario->tipo_usuario == TipoUsuario::ADMINISTRADOR) {
            return true;
        }
        return false;
    }
}
