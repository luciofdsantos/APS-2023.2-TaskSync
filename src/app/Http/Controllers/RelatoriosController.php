<?php

namespace App\Http\Controllers;

use App\Helpers\RelatoriosHelper;
use App\Models\AreaDeServico;
use App\Models\Equipe;
use App\Models\Usuario\TipoUsuario;
use App\Models\Usuario\Usuario;
use Illuminate\Http\Request;

class RelatoriosController extends Controller
{
    public function index()
    {
        return view('relatorios.index');
    }

    public function tarefasArea()
    {
        $areas_de_servico = AreaDeServico::all();

        return view('relatorios.tarefas-area', ['areas_de_servico' => $areas_de_servico]);
    }

    public function buscaTarefasArea(Request $request)
    {
        $areas_de_servico = AreaDeServico::all();
        $tarefas = RelatoriosHelper::filtraRelatorioAreaDeServico($request);

        return view('relatorios.tarefas-area', ['areas_de_servico' => $areas_de_servico, 'tarefas' => $tarefas]);
    }

    public function funcionarios()
    {
        $funcionarios = Usuario::where('tipo_usuario', '=', TipoUsuario::FUNCIONARIO)->get();


        return view('relatorios.funcionarios', ['funcionarios' => $funcionarios]);
    }

    public function buscaTarefasFuncionarios(Request $request)
    {
        $funcionarios = Usuario::where('tipo_usuario', '=', TipoUsuario::FUNCIONARIO)->get();
        $itens = RelatoriosHelper::filtraRelatorioFuncionarios($request);
        return view('relatorios.funcionarios', ['funcionarios' => $funcionarios, 'itens' => $itens]);
    }

    public function clientes()
    {
        $clientes = Usuario::where('tipo_usuario', '=', value: TipoUsuario::CLIENTE)->get();

        return view('relatorios.clientes', ['clientes' => $clientes]);
    }

    public function buscaSolicitacoesClientes(Request $request)
    {
        $clientes = Usuario::where('tipo_usuario', '=', value: TipoUsuario::CLIENTE)->get();
        $itens = RelatoriosHelper::filtraRelatorioClientes($request);

        return view('relatorios.clientes', ['clientes' => $clientes, 'itens' => $itens]);
    }
}
