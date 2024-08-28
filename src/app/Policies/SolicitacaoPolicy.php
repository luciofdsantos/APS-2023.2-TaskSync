<?php

namespace App\Policies;

use App\Models\Solicitacao\Solicitacao;
use App\Models\Solicitacao\StatusSolicitacao;
use App\Models\User;
use App\Models\Usuario\TipoUsuario;
use DateTime;
use Illuminate\Auth\Access\Response;

class SolicitacaoPolicy
{
    public function editar(User $user, Solicitacao $solicitacao)
    {
        if($solicitacao->status != StatusSolicitacao::PENDENTE){
            return false;
        }

        if ($user->id == $solicitacao->cliente_id) {
            if ($this->checaTempo($solicitacao)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function delete(User $user, Solicitacao $solicitacao): bool
    {
        $usuario = session()->get('usuario');

        if ($usuario->tipo_usuario == TipoUsuario::ADMINISTRADOR) {
            return true;
        }

        return false;
    }

    public function cancelar(User $user, Solicitacao $solicitacao): bool
    {
        if($solicitacao->status == StatusSolicitacao::CANCELADA){
            return false;
        }

        $usuario = $user->usuario;
        if ($usuario->tipo_usuario == TipoUsuario::CLIENTE) {
            if ($this->checaTempo($solicitacao)) {
                return true;
            }
        }
        return false;
    }

    public function mudarStatus(User $user, Solicitacao $solicitacao){
        if($solicitacao->status != StatusSolicitacao::PENDENTE){
            return false;
        }
        return true;
    }

    public function visualizar(User $user)
    {
        $usuario = session()->get('usuario');

        if ($usuario->tipo_usuario == TipoUsuario::CLIENTE) {
            return false;
        }
        return true;
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
