<?php

namespace App\Http\Controllers;

use App\Models\AreaDeServico;
use App\Models\Tarefa\Tarefa;
use App\Models\Nota;
use App\Models\Tarefa\StatusTarefa;
use App\Models\Usuario\TipoUsuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TarefaController extends Controller
{

    //Listar Todas as Tarefas
    public function index()
    {
        $this->authorize('tarefas', Tarefa::class);

        $tarefas = null;
        $usuario = auth()->user()->usuario;

        switch ($usuario->tipo_usuario) {
            case TipoUsuario::ADMINISTRADOR:
                $tarefas = Tarefa::with('notas')->paginate(10);
                break;
            case TipoUsuario::FUNCIONARIO:
                $tarefas = Tarefa::leftJoin('tarefa_usuarios', 'tarefa_id', '=', 'tarefas.id')
                    ->where('tarefa_usuarios.usuario_id', '=', $usuario->id)->paginate(10);
                break;
            case TipoUsuario::GERENTE:
                $tarefas = Tarefa::leftJoin('area_de_servico_tarefas', 'area_de_servico_tarefas.tarefa_id', '=', 'tarefas.id')
                    ->leftJoin('area_de_servico', 'area_de_servico.id', '=', 'area_de_servico_tarefas.area_de_servico_id')
                    ->where('area_de_servico.gerente_id', '=', $usuario->id)->paginate(10);
        }
        // $tarefas = Tarefa::paginate(10);

        return view('tarefa.index', compact('tarefas'));
    }

    public function create(AreaDeServico $areaDeServico = null)
    {
        return view('tarefa.create', ['area_de_servico' => $areaDeServico]);
    }


    //Armazenar ma nova Tarefa
    public function store(Request $request, AreaDeServico $area_de_servico)
    {
        $this->authorize('tarefas', Tarefa::class);
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
        return redirect()->route('area-de-servico.show', ['area_de_servico' => $area_de_servico])->with('success', 'Tarefa criada com sucesso!');
    }

    // //Mostra detalhes de uma tarefa
    // public function show(Tarefa $tarefa, $id)   //$id, para receber a tarefa
    // {
    //     $this->authorize('tarefas', Tarefa::class);
    //     $tarefa = Tarefa::with('notes')->findOrFail($id); //Alteração para mostrar as notas de uma tarefa do funcionario
    //     return view('tarefa.show', compact('tarefa'));
    // }

    //Mostra detalhes de uma tarefa
    public function show(Tarefa $tarefa)
    {
        $this->authorize('tarefas', Tarefa::class); // Certifique-se de que a política de autorização está configurada corretamente

        // Carrega as notas associadas à tarefa
        $tarefa->load('notas');

        return view('tarefa.show', compact('tarefa'));
    }

    // Mostrar formulário de edição de tarefa
    public function edit(Tarefa $tarefa)
    {
        $this->authorize('tarefas', Tarefa::class);
        return view('tarefa.edit', compact('tarefa'));
    }

    // Atualizar uma tarefa
    public function update(Request $request, Tarefa $tarefa)
    {
        $this->authorize('tarefas', Tarefa::class);
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
        $this->authorize('tarefas', Tarefa::class);
        try {
            $tarefa->delete();
        } catch (Exception $e) {
            return redirect()->route('tarefa.index')->with('danger', "Não é possível excluir tarefa!\nTarefa com funcionários.");
        }
        return redirect()->route('tarefa.index')->with('success', 'Tarefa excluída com sucesso!');
    }

    //Adicionar Nota

    public function storeNote($id, Request $request)
    {

        $tarefa = Tarefa::findOrFail($id);

        if (is_null($tarefa->id)) {
            return redirect()->back()->withErrors('ID da tarefa não encontrado.');
        }



        // Cria uma nova nota associada à tarefa
        $nota = $tarefa->notas()->create([
            'description' => $request->input('description'),
            'tarefa_id' => $tarefa->id,
        ]);

        return redirect()->route('tarefa.show', ['tarefa' => $tarefa]);
    }

    public function addNoteForm($id)
    {
        $tarefa = Tarefa::findOrFail($id);
        return view('tarefa.formNote', compact('tarefa'));
    }

    public function destroyNote($id)
    {
        $nota = Nota::findOrFail($id);
        $nota->delete();

        return redirect()->back()->with('success', 'Nota excluída com sucesso!');
    }

    //Mostrar as notas
    public function showNotas($tarefaId)
    {
        // Encontre a tarefa pelo ID
        $tarefa = Tarefa::findOrFail($tarefaId);

        // Carregue as notas associadas à tarefa
        $notas = $tarefa->notas;

        // Retorne a view com as notas
        return view('tarefa.notas', compact('tarefa', 'notas'));
    }


    public function updateStatus(Request $request, $id)
    {
        $tarefa = Tarefa::findOrFail($id);

        // Verifique se o status enviado é válido
        if (!in_array($request->status, array_keys(StatusTarefa::getAll()))) {
            return redirect()->back()->with('error', 'Status inválido.');
        }

        $tarefa->status = $request->status;

        if ($tarefa->status == StatusTarefa::CONCLUIDA) {
            $tarefa->data_conclusao = date('Y-m-d');
        }

        $tarefa->save();

        return redirect()->route('tarefa.index')->with('success', 'Status atualizado com sucesso!');
    }
}
