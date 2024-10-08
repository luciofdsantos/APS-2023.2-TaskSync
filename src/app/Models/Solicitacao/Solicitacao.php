<?php

namespace App\Models\Solicitacao;

use App\Models\Usuario\TipoUsuario;
use App\Models\Usuario\Usuario;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Solicitacao extends Model
{
    use HasFactory;
    protected $fillable = [
        'assunto',
        'descricao',
        'categoria',
        'prazo',
        'status',
        'cliente_id'
    ];
    protected $table = 'solicitacoes';

    public function cliente() : HasOne{

        return $this->hasOne(Usuario::class, 'id','cliente_id');
    }

    public function podeEditar(): bool
    {
        if (auth()->user()->usuario->tipo_usuario == TipoUsuario::ADMINISTRADOR) {
            return true;
        }

        if ($this->status != StatusSolicitacao::PENDENTE) {
            return false;
        }

        $prazo = new DateTime($this->prazo);
        $atual = new DateTime();

        if ($prazo->diff($atual)->days < 1) {
            return false;
        }

        return true;
    }
}
