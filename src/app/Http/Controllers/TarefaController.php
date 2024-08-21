<?php

namespace App\Http\Controllers;

use App\Models\AreaDeServico;
use App\Models\Tarefa\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TarefaController extends Controller
{

    //Listar Todas as Tarefas
    public function index()
    {
        $tarefas = Tarefa::paginate(10);
        return view('tarefa.index', compact('tarefas'));
    }

    public function create(AreaDeServico $areaDeServico = null)
    {
        return view('tarefa.create', ['area_de_servico' => $areaDeServico]);
    }


    //Armazenar ma nova Tarefa
    public function store(Request $request, AreaDeServico $area_de_servico)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'deadline' => 'nullable|date',
        ]);
        $area_de_servico = AreaDeServico::where('id', '=', $request->area_de_servico)->first();

        $tarefa = Tarefa::create($request->all());

        if ($area_de_servico->id) {
            DB::table('area_de_servico_tarefas')->insert(
                [
                    'area_de_servico_id' => $area_de_servico->id,
                    'tarefa_id' => $tarefa->id,
                ]
            );
        }
        return redirect()->route('area-de-servico.show', ['area_de_servico' => $area_de_servico]);
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
