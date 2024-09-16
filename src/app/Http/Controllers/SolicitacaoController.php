<?php

namespace App\Http\Controllers;

use App\Models\Solicitacao\Solicitacao;
use App\Models\Solicitacao\StatusSolicitacao;
use App\Models\Usuario\TipoUsuario;
use Exception;
use Illuminate\Http\Request;

class SolicitacaoController extends Controller
{
    public function index()
    {
        $solicitacoes = $this->getSolicitacoes();

        return view('solicitacoes.index', compact('solicitacoes'));
    }

    #Criar Solicitação
    public function create()
    {
        return view('solicitacoes.create');
    }

    #Encaminhar solicitação
    public function store(Request $request)
    {
        $request->validate([
            'assunto' => 'required',
            'descricao' => 'required',
            'categoria' => 'required',
        ]);

        $campos = $request->all();
        $campos['cliente_id'] = auth()->user()->id;

        Solicitacao::create($campos);

        return redirect()->route('solicitacoes.index')
            ->with('success', 'Solicitação encaminhada com sucesso!');
    }

    #Editar uma solicitação
    public function edit(Solicitacao $solicitacao)
    {
        return view('solicitacoes.edit', compact('solicitacao'));
    }

    #Atualizar Solicitação
    public function update(Request $request, Solicitacao $solicitacao)
    {
        $request->validate([
            'assunto' => 'required',
            'descricao' => 'required',
            'categoria' => 'required',
        ]);

        $solicitacao->update($request->all());

        return redirect()->route('solicitacoes.index')
            ->with('success', 'Solicitação atualizada com sucesso!');
    }

    public function cancelar(Solicitacao $solicitacao)
    {
        if (!$solicitacao->podeEditar()) {
            return redirect()->route('solicitacoes.index')
                ->with('warning', 'Não foi possível cancelar seu pedido.');
        }

        $solicitacao->update(['status' => StatusSolicitacao::CANCELADA]);
        return redirect()->route('solicitacoes.index')
            ->with('success', 'Seu pedido foi cancelado');
    }

    public function mudarStatus(Solicitacao $solicitacao, bool $cancelar = false)
    {
        if ($cancelar) {
            $solicitacao->update(['status' => StatusSolicitacao::CANCELADA]);
            return redirect()->route('solicitacoes.show', ['solicitacao' => $solicitacao])
                ->with('success', 'Solicitação cancelada!');
        } else {
            $solicitacao->update(['status' => StatusSolicitacao::AGENDADA]);
            return redirect()->route('solicitacoes.show', ['solicitacao' => $solicitacao])
                ->with('success', 'Solicitação cancelada!');
        }
    }

    // Excluir uma tarefa
    public function destroy(Solicitacao $solicitacao)
    {
        $this->authorize('delete', $solicitacao);
        try {
            $solicitacao->delete();
        } catch (Exception $e) {
            return redirect()->route('solicitacoes.index')->with('danger', "Não é possível excluir solicitação!.");
        }
        return redirect()->route('solicitacoes.index')->with('success', 'Solicitação excluída com sucesso!');
    }

    public function show(Solicitacao $solicitacao)
    {

        return view('solicitacoes.show', ['solicitacao' => $solicitacao]);
    }


    private function getSolicitacoes()
    {
        $usuario = auth()->user()->usuario;
        if ($usuario->tipo_usuario == TipoUsuario::CLIENTE) {
            $solicitacoes = Solicitacao::where('cliente_id', '=', $usuario->id)->paginate(10);
        } else {
            $solicitacoes = Solicitacao::orderBy('status', 'asc')
                ->orderBy('updated_at')
                ->paginate(10);
        }
        return $solicitacoes;
    }
}
