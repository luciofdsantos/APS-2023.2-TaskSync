<?php

namespace App\Helpers;

use App\Models\AreaDeServico;
use App\Models\Tarefa\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatoriosHelper
{

    public static function filtraRelatorioAreaDeServico(Request $request)
    {
        $tarefas = Tarefa::query();

        $tarefas->leftJoin(
            'area_de_servico_tarefas',
            'tarefa_id',
            '=',
            'tarefas.id'
        );

        if ($request->area_de_servico_id) {
            $tarefas->where('area_de_servico_id', '=', $request->area_de_servico_id);
        }

        $tarefas->orderBy('tarefas.created_at', 'desc');

        return $tarefas->get();
    }

    public static function filtraRelatorioFuncionarios(Request $request)
    {
        $query = DB::table('tarefas');

        $query->select([
            'tarefas.id as id',
            'users.name as nome',
            'tarefas.titulo as tarefa_nome',
            'tarefas.descricao as tarefa_descricao',
            'tarefas.prazo as prazo',
            'tarefas.status as status',
            'tarefas.data_conclusao as conclusao',
        ]);

        $query->leftJoin(
            'tarefa_usuarios',
            'tarefa_id',
            '=',
            'tarefas.id'
        );

        $query->join(
            'usuario',
            'usuario_id',
            '=',
            'usuario.id'
        );

        $query->leftJoin('users', 'usuario.id', '=', 'users.id');

        if ($request->funcionario_id) {
            $query->where('usuario.id', '=', $request->funcionario_id);
        }

        $query->orderBy('tarefas.created_at', 'desc');

        return $query->get();
    }

    public static function filtraRelatorioClientes(Request $request)
    {
        $query = DB::table('solicitacoes');

        $query->select([
            'solicitacoes.id as id',
            'users.name as nome',
            'solicitacoes.assunto as assunto',
            'solicitacoes.descricao as descricao',
            'solicitacoes.prazo as prazo',
            'solicitacoes.status as status',
        ]);

        $query->leftJoin(
            'usuario',
            'cliente_id',
            '=',
            'usuario.id'
        );

        $query->leftJoin('users', 'usuario.id', '=', 'users.id');

        if ($request->cliente_id) {
            $query->where('usuario.id', '=', $request->cliente_id);
        }

        $query->orderBy('solicitacoes.created_at', 'desc');

        return $query->get();
    }
}
