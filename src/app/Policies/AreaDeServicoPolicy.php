<?php

namespace App\Policies;

use App\Models\AreaDeServico;
use App\Models\Tarefa\Tarefa;
use App\Models\User;
use App\Models\Usuario\TipoUsuario;
use Illuminate\Auth\Access\Response;

class AreaDeServicoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function areasDeServico(User $user): bool
    {
        $usuario = $user->usuario;

        if (
            $usuario->tipo_usuario == TipoUsuario::GERENTE ||
            $usuario->tipo_usuario == TipoUsuario::ADMINISTRADOR
        ) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $usuario = $user->usuario;

        if (
            $usuario->tipo_usuario == TipoUsuario::GERENTE ||
            $usuario->tipo_usuario == TipoUsuario::ADMINISTRADOR
        ) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AreaDeServico $areaDeServico): bool
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

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AreaDeServico $areaDeServico): bool
    {
        $usuario = $user->usuario;

        if (
            $usuario->tipo_usuario == TipoUsuario::ADMINISTRADOR
        ) {
            return true;
        }
        return false;
    }

    public function mudarEstado(User $user, AreaDeServico $areaDeServico, Tarefa $tarefa): bool
    {
        $usuario = $user->usuario;

        if (
            $usuario->tipo_usuario == TipoUsuario::ADMINISTRADOR ||
            $usuario->tipo_usuario == TipoUsuario::GERENTE
        ) {
            return true;
        } else {
            foreach ($tarefa->funcionarios as $funcionario) {
                if ($user->id == $funcionario->id) {
                    return true;
                }
            }
        }

        return false;
    }
}
