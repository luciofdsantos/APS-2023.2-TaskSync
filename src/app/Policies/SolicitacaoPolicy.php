<?php

namespace App\Policies;

use App\Models\Solicitacao\Solicitacao;
use App\Models\User;
use App\Models\Usuario\TipoUsuario;
use DateTime;
use Illuminate\Auth\Access\Response;

class SolicitacaoPolicy
{

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function delete(User $user, Solicitacao $solicitacao): bool
    {
        $usuario = $user->usuario;

        if ($usuario->tipo_usuario == TipoUsuario::ADMINISTRADOR) {
            return true;
        }

        return false;
    }

    public function cancelar(User $user, Solicitacao $solicitacao): bool
    {
        $usuario = $user->usuario;
        if ($usuario->tipo_usuario == TipoUsuario::CLIENTE) {
            if ($this->checaTempo($solicitacao)) {
                return true;
            }
        }
        return false;
    }

    private function checaTempo(Solicitacao $solicitacao)
    {
        $prazo = new DateTime($solicitacao->prazo);
        $atual = new DateTime();

        if ($prazo->diff($atual)->days < 1) {
            return false;
        }
        return true;
    }
}
