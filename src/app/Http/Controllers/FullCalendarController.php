<?php

namespace App\Http\Controllers;

use App\Models\AreaDeServico;
use App\Models\Tarefa\Prioridade;
use App\Models\Tarefa\Tarefa;
use App\Models\Usuario\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FullCalendarController extends Controller
{
    public function index(Request $request)
    {
        $areas = AreaDeServico::all();
        $url = route('calendar.get');

        if ($request->isMethod('post')) {
            if ($request->area_de_servico_id) {
                $url = route('calendar.get', ['area_de_servico_id' => $request->area_de_servico_id]);
            }
        }

        return view('full-calendar.master', ['areas' => $areas, 'url' => $url]);
    }

    public function get(Request $request, $area_de_servico_id = null)
    {
        $tarefas = DB::table('tarefas')
            ->select([
                'tarefas.id as id',
                'tarefas.titulo as titulo',
                'tarefas.prazo as prazo',
                'tarefas.prioridade as prioridade',
                'area_de_servico.id as area_de_servico'
            ])
            ->join(
                'area_de_servico_tarefas',
                'tarefas.id',
                '=',
                'area_de_servico_tarefas.tarefa_id'
            )
            ->join(
                'area_de_servico',
                'area_de_servico.id',
                '=',
                'area_de_servico_tarefas.area_de_servico_id'
            );



        $usuario = auth()->user();

        switch ($usuario->tipo_usuario) {
            case TipoUsuario::FUNCIONARIO:
                $tarefas->join('tarefa_usuarios', 'tarefa_id', '=', 'tarefas.id');
                $tarefas->where('tarefa_usuarios.usuario_id', '=', $usuario->id);
                break;
            case TipoUsuario::GERENTE:
                $tarefas->where('area_de_servico.gerente_id', '=', $usuario->id);
                break;
        }

        if ($area_de_servico_id) {
            $tarefas->where('area_de_servico_id', '=', $area_de_servico_id);
        }
        $tarefas = $tarefas->get();

        $data = [];

        foreach ($tarefas as $tarefa) {
            $data[] = [
                'id' => $tarefa->id,
                'groupId' => $tarefa->area_de_servico,
                'title' => $tarefa->titulo,
                'start' => $tarefa->prazo,
                'color' => Prioridade::getCor($tarefa->prioridade),
                'textColor' => 'white',
            ];
        }

        return response()->json($data);
    }
}
