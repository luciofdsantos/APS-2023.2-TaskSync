<?php

namespace App\Http\Controllers;
use App\Models\Tarefa\Tarefa;
use Illuminate\Http\Request;

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

    public function create()
    {
        return view('tarefa.create');
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

        Tarefa::create($request->all());

        return redirect()->route('tarefa.index')->with('success', 'Tarefa criada com sucesso.');
    }

    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show', compact('tarefa'));
    }
}

