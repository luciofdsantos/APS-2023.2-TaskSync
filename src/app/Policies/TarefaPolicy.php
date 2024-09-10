<?php

namespace App\Policies;

use App\Models\Tarefa\StatusTarefa;
use App\Models\Tarefa\Tarefa;
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

    public function alterarStatus(User $user): bool
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
    public function editar(User $user): bool
    {
        $usuario = $user->usuario;
        if (
            $usuario->tipo_usuario == TipoUsuario::ADMINISTRADOR ||
            $usuario->tipo_usuario == TipoUsuario::GERENTE
        ) {
            return true;
        }

        return false;
    }

    public function status(User $user, Tarefa $tarefa)
    {
        if ($tarefa->status == StatusTarefa::CONCLUIDA) {
            return false;
        }

        return true;
    }
}
