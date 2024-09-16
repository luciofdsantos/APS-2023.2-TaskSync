<?php

namespace App\Helpers;

use App\Models\AreaDeServico;
use App\Models\Equipe;
use App\Models\Usuario\TipoUsuario;
use Illuminate\Support\Facades\DB;

class FuncionarioHelper
{
    public static function getFuncionarios()
    {
        return DB::table('usuario')
            ->select(['usuario.id', 'users.name as nome'])
            ->join('users', 'usuario.id', '=', 'users.id')
            ->where('usuario.tipo_usuario', '=', TipoUsuario::FUNCIONARIO)
            ->get();
    }

    public static function getFuncionariosByAreaDeServico(AreaDeServico $area_de_servico)
    {
        $ids = array_column($area_de_servico->funcionarios->all(), 'id');
        $query = DB::table('usuario')
            ->select(['usuario.id', 'users.name as nome'])
            ->join('users', 'usuario.id', '=', 'users.id')
            ->where('usuario.tipo_usuario', '=', TipoUsuario::FUNCIONARIO)
            ->whereNotIn('usuario.id', $ids);

        return $query->get();
    }

    public static function getFuncionariosByEquipe(Equipe $equipe)
    {
        $ids = array_column($equipe->funcionarios->all(), 'id');
        $query = DB::table('usuario')
            ->select(['usuario.id', 'users.name as nome'])
            ->join('users', 'usuario.id', '=', 'users.id')
            ->where('usuario.tipo_usuario', '=', TipoUsuario::FUNCIONARIO)
            ->whereNotIn('usuario.id', $ids);

        return $query->get();
    }
}
