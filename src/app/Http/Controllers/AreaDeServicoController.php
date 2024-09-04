<?php

namespace App\Http\Controllers;

use App\Helpers\ArraysHelper;
use App\Helpers\FuncionarioHelper;
use App\Models\AreaDeServico;
use App\Http\Requests\StoreAreaDeServicoRequest;
use App\Http\Requests\UpdateAreaDeServicoRequest;
use App\Models\AreaDeServicoFuncionarios;
use App\Models\Equipe;
use App\Models\EquipeAreaDeServico;
use App\Models\Tarefa\StatusTarefa;
use App\Models\Tarefa\Tarefa;
use App\Models\Usuario\TipoUsuario;
use App\Models\Usuario\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AreaDeServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('areasDeServico', AreaDeServico::class);
        $areas_de_servico = AreaDeServico::paginate(10);

        return view('area-de-servico.index', ['areas_de_servico' => $areas_de_servico]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', AreaDeServico::class);
        $gerentes = $this->getGerentes();
        $funcionarios = ArraysHelper::to_array(FuncionarioHelper::getFuncionarios());


        return view('area-de-servico.create', ['gerentes' => $gerentes, 'funcionarios' => $funcionarios]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAreaDeServicoRequest $request)
    {
        $campos = $request->validated();
        $area = AreaDeServico::create($campos);

        // foreach ($campos['selectedItems'] as $funcionario_id) {
        //     $area_funcionario = new AreaDeServicoFuncionarios();

        //     $area_funcionario->funcionario_id = $funcionario_id;
        //     $area_funcionario->area_de_servico_id = $area->id;

        //     $area_funcionario->save();
        // }

        return redirect()->route('area-de-servico.show', ['area_de_servico' => $area]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AreaDeServico $areaDeServico)
    {
        $tarefas = $areaDeServico->tarefas;
        // dd($areaDeServico->funcionarios);
        return view('area-de-servico.show', [
            'area_de_servico' => $areaDeServico,
            'tarefas' => $tarefas,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AreaDeServico $areaDeServico)
    {
        $this->authorize('update', $areaDeServico);
        $gerentes = $this->getGerentes();
        $funcionarios = ArraysHelper::to_array(FuncionarioHelper::getFuncionariosByAreaDeServico($areaDeServico));
        $selected_funcionarios = $areaDeServico->funcionarios->all();

        return view('area-de-servico.edit', [
            'area_de_servico' => $areaDeServico,
            'gerentes' => $gerentes,
            'funcionarios' => $funcionarios,
            'selected_funcionarios' => $selected_funcionarios
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaDeServicoRequest $request, AreaDeServico $areaDeServico)
    {
        $this->authorize('update', $areaDeServico);
        $campos = $request->validated();
        // $funcionarios = $campos['selectedItems'];
        // $funcionarios_salvos = array_column($areaDeServico->servicoTarefas->all(), 'funcionario_id');

        // foreach ($funcionarios_salvos as $funcionario) {
        //     if (!in_array($funcionario, $funcionarios)) {
        //         $funcionario->delete();
        //     }
        // }

        // foreach ($funcionarios as $funcionario) {
        //     if (!in_array($funcionario, $funcionarios_salvos)) {
        //         $area = new AreaDeServicoFuncionarios();
        //         $area->funcionario_id = $funcionario;
        //         $area->area_de_servico_id = $areaDeServico->id;
        //         $area->save();
        //     }
        // }

        $areaDeServico->update($campos);

        return view('area-de-servico.show', ['area_de_servico' => $areaDeServico, 'tarefas' => $areaDeServico->tarefas]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AreaDeServico $areaDeServico)
    {
        $this->authorize('delete', $areaDeServico);
        $areaDeServico->delete();

        return redirect()->route('area-de-servico.index');
    }

    public function modifica(Request $request, AreaDeServico $area_de_servico)
    {

        $return = [];
        if ($request->tarefas_a_fazer) {
            $tarefas = explode(',', $request->tarefas_a_fazer);
            foreach ($tarefas as $tarefa_id) {
                $return[] = Tarefa::whereId($tarefa_id)->update([
                    'status' => StatusTarefa::A_FAZER,
                ]);
            }
        }

        if ($request->tarefas_fazendo) {
            $tarefas = explode(',', $request->tarefas_fazendo);
            foreach ($tarefas as $tarefa_id) {
                $return[] = Tarefa::whereId($tarefa_id)->update([
                    'status' => StatusTarefa::FAZENDO,
                ]);
            }
        }

        if ($request->tarefas_concluida) {
            $tarefas = explode(',', $request->tarefas_concluida);
            foreach ($tarefas as $tarefa_id) {
                $return[] = Tarefa::whereId($tarefa_id)->update([
                    'status' => StatusTarefa::CONCLUIDA,
                ]);
            }
        }

        return response()->json(["success" => [$return]]);
    }

    public function equipe(AreaDeServico $area_de_servico)
    {
        $equipes = Equipe::all();

        $equipes_area = EquipeAreaDeServico::select('equipe_id')
            ->where('area_de_servico_id', '=', $area_de_servico->id)
            ->pluck('equipe_id')
            ->toArray();

        return view('area-de-servico.equipe', [
            'area_de_servico' => $area_de_servico,
            'equipes' => $equipes,
            'equipes_area' => $equipes_area,
        ]);
    }

    public function addEquipe(AreaDeServico $area_de_servico, Equipe $equipe)
    {
        EquipeAreaDeServico::create([
            'area_de_servico_id' => $area_de_servico->id,
            'equipe_id' => $equipe->id,
        ]);

        $funcionarios_area = $area_de_servico->funcionarios->pluck('id')->toArray();
        $funcionarios_equipe = $equipe->funcionarios->pluck('id')->toArray();

        foreach ($funcionarios_equipe as $funcionario_id) {
            if (!in_array($funcionario_id, $funcionarios_area)) {
                DB::table('area_de_servico_funcionarios')
                    ->insert([
                        'area_de_servico_id' => $area_de_servico->id,
                        'funcionario_id' => $funcionario_id,
                    ]);
            }
        }

        return redirect()->route('area-de-servico.equipe', ['area_de_servico' => $area_de_servico])
            ->with('success', 'Equipe adicionada com sucesso!');
    }

    public function delEquipe(AreaDeServico $area_de_servico, Equipe $equipe)
    {
        $funcionarios_area = $area_de_servico->funcionarios->pluck('id')->toArray();
        $funcionarios_equipe = $equipe->funcionarios->pluck('id')->toArray();

        foreach ($funcionarios_equipe as $funcionario_id) {
            if (in_array($funcionario_id, $funcionarios_area)) {

                DB::table('area_de_servico_funcionarios')
                    ->where([
                        'area_de_servico_id' => $area_de_servico->id,
                        'funcionario_id' => $funcionario_id,
                    ])->delete();

                DB::table('tarefa_usuarios', 'tarefa')
                    ->leftJoin('area_de_servico_tarefas', 'area_de_servico_tarefas.tarefa_id', '=', 'tarefa.tarefa_id')
                    ->where('area_de_servico_tarefas.area_de_servico_id', '=', $area_de_servico->id)
                    ->where('tarefa.usuario_id', '=', $funcionario_id)
                    ->delete();
            }
        }


        DB::table('equipe_area_de_servico')->where('equipe_id', '=', $equipe->id)
            ->where('area_de_servico_id', '=', $area_de_servico->id)
            ->delete();

        return redirect()->route('area-de-servico.equipe', ['area_de_servico' => $area_de_servico])
            ->with('success', 'Equipe removida com sucesso!');
    }

    public function salvaFuncionario(Request $request, AreaDeServico $area_de_servico)
    {
        $this->authorize('update', $area_de_servico);
        if ($request->funcionarios) {
            $tarefa_salva = Tarefa::where('id', '=', $request->tarefa_id)->first();
            $funcionarios_selecionados = $request->funcionarios;
            $funcionarios_salvos = $tarefa_salva->funcionarios->toArray();

            foreach ($funcionarios_salvos as $funcionario) {
                if (!in_array($funcionario['id'], $funcionarios_selecionados)) {
                    DB::table('tarefa_usuarios')->where([
                        'usuario_id' => $funcionario['id'],
                        'tarefa_id' => $tarefa_salva->id,
                    ])->delete();
                }
            }

            foreach ($funcionarios_selecionados as $funcionario_id) {
                DB::table('tarefa_usuarios')->updateOrInsert([
                    'tarefa_id' => $tarefa_salva->id,
                    'usuario_id' => $funcionario_id,
                ]);
            }
        } else {
            DB::table('tarefa_usuarios')->where(['tarefa_id' => $request->tarefa_id])->delete();
        }

        return redirect()->route("area-de-servico.show", ['area_de_servico' => $area_de_servico]);
    }

    public function adicionaFuncionario(Request $request, AreaDeServico $area_de_servico, Tarefa $tarefa)
    {
        $funcionarios_id = array_column($area_de_servico->funcionarios->toArray(), 'id');
        $funcionarios_tarefa = array_column($tarefa->funcionarios->toArray(), 'id');

        return response()->json([
            'funcionarios_id' => $funcionarios_id,
            'funcionarios_tarefa' => $funcionarios_tarefa,
        ]);
    }

    private function getGerentes()
    {
        return Usuario::where('tipo_usuario', '=', TipoUsuario::GERENTE)
            ->orWhere('tipo_usuario', '=', TipoUsuario::ADMINISTRADOR)->get();
    }
}
