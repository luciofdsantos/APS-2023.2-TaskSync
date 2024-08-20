<?php

namespace App\Http\Controllers;

use App\Models\AreaDeServico;
use App\Models\Tarefa\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TarefaController extends Controller
{
    //Serve para permitir que apenas usuários autenticados consigam acessar as
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $tarefas = Tarefa::all();
        return view('tarefa.index', compact('tarefas'));
    }

    public function create(AreaDeServico $areaDeServico = null)
    {
        return view('tarefa.create', ['area_de_servico' => $areaDeServico]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'gerente_responsavel' => 'required',
            'email_contato' => 'required|email',
            'status' => 'required',
            'descricao' => 'required',
        ]);

        $tarefa = Tarefa::create($request->all());

        if ($request->area_de_servico_id) {
            DB::table('area_de_servico_tarefas')->insert(
                [
                    'area_de_servico_id' => $request->area_de_servico_id,
                    'tarefa_id' => $tarefa->id,
                ]
            );
        }

        return redirect()->route('area-de-servico.show', ['area_de_servico' => $request->area_de_servico_id]);
    }

    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show', compact('tarefa'));
    }
}
