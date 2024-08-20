<?php

namespace App\Http\Controllers;

use App\Helpers\ArraysHelper;
use App\Models\AreaDeServico;
use App\Http\Requests\StoreAreaDeServicoRequest;
use App\Http\Requests\UpdateAreaDeServicoRequest;
use App\Models\AreaDeServicoFuncionarios;
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
        $areas_de_servico = AreaDeServico::paginate(10);

        return view('area-de-servico.index', ['areas_de_servico' => $areas_de_servico]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gerentes = $this->getGerentes();
        $funcionarios = ArraysHelper::to_array($this->getFuncionarios());


        return view('area-de-servico.create', ['gerentes' => $gerentes, 'funcionarios' => $funcionarios]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAreaDeServicoRequest $request)
    {
        $campos = $request->validated();
        $area = AreaDeServico::create($campos);

        foreach ($campos['selectedItems'] as $funcionario_id) {
            $area_funcionario = new AreaDeServicoFuncionarios();

            $area_funcionario->funcionario_id = $funcionario_id;
            $area_funcionario->area_de_servico_id = $area->id;

            $area_funcionario->save();
        }

        return redirect()->route('area-de-servico.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(AreaDeServico $areaDeServico)
    {
        $tarefas = $areaDeServico->tarefas;

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
        $gerentes = $this->getGerentes();
        $funcionarios = ArraysHelper::to_array($this->getFuncionariosUpdate($areaDeServico));
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
        $campos = $request->validated();
        $funcionarios = $campos['selectedItems'];
        $funcionarios_salvos = array_column($areaDeServico->servicoTarefas->all(), 'funcionario_id');

        foreach ($funcionarios_salvos as $funcionario) {
            if (!in_array($funcionario, $funcionarios)) {
                $funcionario->delete();
            }
        }

        foreach ($funcionarios as $funcionario) {
            if (!in_array($funcionario, $funcionarios_salvos)) {
                $area = new AreaDeServicoFuncionarios();
                $area->funcionario_id = $funcionario;
                $area->area_de_servico_id = $areaDeServico->id;
                $area->save();
            }
        }

        $areaDeServico->update($campos);

        return view('area-de-servico.show', ['area_de_servico' => $areaDeServico]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AreaDeServico $areaDeServico)
    {
        //
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

    public function adicionaFuncionario(Request $request, AreaDeServico $area_de_servico, Tarefa $tarefa)
    {
        if ($request->funcionarios) {
            foreach ($request->funcionarios as $funcionario_id) {
                DB::table('tarefa_usuarios')->updateOrInsert([
                    'tarefa_id' => $request->tarefa,
                    'usuario_id' => $funcionario_id,
                ]);
            }
        }

        return redirect()->route("area-de-servico.show", ['area_de_servico' => $area_de_servico]);
    }

    private function getFuncionarios()
    {
        return DB::table('usuario')
            ->select(['usuario.id', 'users.name as nome'])
            ->join('users', 'usuario.id', '=', 'users.id')
            ->where('usuario.tipo_usuario', '=', TipoUsuario::FUNCIONARIO)
            ->get();
    }

    private function getFuncionariosUpdate(AreaDeServico $area_de_servico)
    {
        $ids = array_column($area_de_servico->funcionarios->all(), 'id');
        $query = DB::table('usuario')
            ->select(['usuario.id', 'users.name as nome'])
            ->join('users', 'usuario.id', '=', 'users.id')
            ->where('usuario.tipo_usuario', '=', TipoUsuario::FUNCIONARIO)
            ->whereNotIn('usuario.id', $ids);

        return $query->get();
    }

    private function getGerentes()
    {
        return Usuario::where('tipo_usuario', '=', TipoUsuario::GERENTE)
            ->orWhere('tipo_usuario', '=', TipoUsuario::ADMINISTRADOR)->get();
    }
}
