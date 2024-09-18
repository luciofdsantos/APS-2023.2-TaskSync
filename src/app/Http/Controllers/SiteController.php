<?php

namespace App\Http\Controllers;

use App\Models\AreaDeServico;
use App\Models\Tarefa\StatusTarefa;
use App\Models\Usuario\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function dashboard()
    {
        $usuario = auth()->user()->usuario;

        if ($usuario->tipo_usuario == TipoUsuario::FUNCIONARIO) {
            return redirect()->route("tarefa.index");
        }
        if ($usuario->tipo_usuario == TipoUsuario::CLIENTE) {
            return redirect()->route("solicitacoes.index");
        }
        $areas_de_servico = null;

        if ($usuario->tipo_usuario == TipoUsuario::GERENTE) {
            $areas_de_servico = AreaDeServico::where('gerente_id', $usuario->id)->paginate(10);
        } else {
            $areas_de_servico = AreaDeServico::paginate(10);
        }



        $tarefas = DB::table('area_de_servico_tarefas')->select([
            'area_de_servico.nome as nome',
            'tarefas.status as status',
            DB::raw('count(tarefas.id) as quantidade'),
        ])
            ->join('tarefas', 'area_de_servico_tarefas.tarefa_id', '=', 'tarefas.id')
            ->join('area_de_servico', 'area_de_servico.id', '=', 'area_de_servico_tarefas.area_de_servico_id')
            ->groupBy(['area_de_servico.nome', 'tarefas.status'])
            ->get();



        $tarefas_funcionarios = DB::table('tarefa_usuarios')
            ->select([
                'users.name as nome',
                DB::raw('count(tarefas.id) as tarefas_concluidas'),
            ])->join('users', 'tarefa_usuarios.usuario_id', '=', 'users.id')
            ->join('tarefas', 'tarefa_usuarios.tarefa_id', '=', 'tarefas.id')
            ->where('tarefas.status', '=', StatusTarefa::CONCLUIDA)
            ->groupBy(['users.name'])
            ->get();
        $status = StatusTarefa::getAll();



        return view('index', [
            'areas_de_servico' => $areas_de_servico,
            'tarefas' => $tarefas,
            'status' => $status,
            'tarefas_funcionarios' => $tarefas_funcionarios
        ]);
    }
}
