<?php

namespace App\Http\Controllers;
use App\Models\Tarefa\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{

    //Listar Todas as Tarefas
    public function index()
    {
        $tarefas = Tarefa::all();
        return view('tarefa.index', compact('tarefas'));
    }

    // Mostrar formularia da criação da Tarefa
    public function create()
    {
        return view('tarefa.create');
    }


    //Armazenar ma nova Tarefa
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'deadline' => 'nullable|date',
        ]);

        Tarefa::create($request->all());

        return redirect()->route('tarefa.index')->with('success', 'Tarefa criada com sucesso.');
    }

    //Mostra detalhes de uma tarefa
    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show', compact('tarefa'));
    }

     // Mostrar formulário de edição de tarefa
     public function edit(Tarefa $tarefa)
     {
         return view('tarefa.edit', compact('tarefa'));
     }

     // Atualizar uma tarefa
    public function update(Request $request, Tarefa $tarefa)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'deadline' => 'nullable|date',
        ]);

        $tarefa->update($validated);

        return redirect()->route('tarefa.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    // Excluir uma tarefa
    public function destroy(Tarefa $tarefa)
    {
        $tarefa->delete();
        return redirect()->route('tarefa.index')->with('success', 'Tarefa excluída com sucesso!');
    }


}

