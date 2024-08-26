<?php

namespace App\Http\Controllers;

use App\Models\Solicitacao\Solicitacao;
use Illuminate\Http\Request;

class SolicitacaoController extends Controller
{
    public function index()
    {
        $solicitacoes = Solicitacao::all();
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

        Solicitacao::create($request->all());

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

    #Deletar Solicitação
    public function destroy(Solicitacao $solicitacao)
    {
        $solicitacao->update(['status' => 'Cancelado']);
        return redirect()->route('solicitacoes.index')
                         ->with('success', 'Seu pedido foi cancelado');
    }
}

