<?php

namespace App\Policies;

use App\Models\Tarefa;
use App\Models\User;
use App\Models\Usuario\TipoUsuario;
use Illuminate\Auth\Access\Response;

class TarefaPolicy
{
    /**
     * Ver tarefas
     */
    public function tarefas(User $user): bool
    {
        $usuario = $user->usuario;
        if (
            $usuario->tipo_usuario == TipoUsuario::ADMINISTRADOR ||
            $usuario->tipo_usuario == TipoUsuario::GERENTE ||
            $usuario->tipo_usuario == TipoUsuario::FUNCIONARIO
        ) {
            return true;
        }

        return false;
    }
}
