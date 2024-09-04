<?php

namespace App\Http\Controllers;

use App\Helpers\ArraysHelper;
use App\Helpers\FuncionarioHelper;
use App\Http\Requests\EquipeRequest;
use App\Models\Equipe;
use App\Models\Usuario\TipoUsuario;
use App\Models\Usuario\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LogicException;

class EquipeController extends Controller
{
    public function index()
    {
        $equipes = Equipe::paginate(10);

        // dd($equipes);

        return view('equipe.index', ['equipes' => $equipes]);
    }

    public function create()
    {
        $funcionarios = ArraysHelper::to_array(FuncionarioHelper::getFuncionarios());

        return view('equipe.create', ['funcionarios' => $funcionarios]);
    }

    public function store(EquipeRequest $request)
    {
        $campos = $request->validated();

        DB::transaction(function () use ($campos) {

            $equipe = Equipe::create($campos);

            foreach ($campos['selectedItems'] as $funcionario_id) {
                DB::table('funcionario_equipe')->insert([
                    'equipe_id' => $equipe->id,
                    'funcionario_id' => $funcionario_id,
                ]);
            }
        });

        return redirect()->route('equipe.index');
    }

    public function edit(Equipe $equipe)
    {
        $funcionarios = ArraysHelper::to_array(FuncionarioHelper::getFuncionariosByEquipe($equipe));
        $selected_funcionarios = $equipe->funcionarios->all();

        return view('equipe.edit', [
            'equipe' => $equipe,
            'funcionarios' => $funcionarios,
            'selected_funcionarios' => $selected_funcionarios
        ]);
    }

    public function update(EquipeRequest $request, Equipe $equipe)
    {
        $campos = $request->validated();
        $funcionarios = $campos['selectedItems'];
        $funcionarios_salvos = array_column($equipe->funcionarios->all(), 'id');

        foreach ($funcionarios_salvos as $funcionario) {
            if (!in_array($funcionario, $funcionarios)) {
                DB::table('funcionario_equipe')
                    ->where('equipe_id', '=', $equipe->id)
                    ->where('funcionario_id', '=', $funcionario)
                    ->delete();
            }
        }

        foreach ($funcionarios as $funcionario) {
            if (!in_array($funcionario, $funcionarios_salvos)) {
                DB::table('funcionario_equipe')
                    ->insert([
                        'funcionario_id' => $funcionario,
                        'equipe_id' => $equipe->id,
                    ]);
            }
        }

        return redirect()->route('equipe.index');
    }

    public function destroy(Equipe $equipe)
    {
        try {
            $equipe->delete();
        } catch (Exception $e) {
            return redirect()->route('equipe.index')->with('danger', 'Não foi possível apagar equipe');
        }
        
        return redirect()->route('equipe.index')->with('success', 'Equipe apagada com sucesso!');
    }

    public function show(Equipe $equipe)
    {
        return view('equipe.show', ['equipe' => $equipe]);
    }
}
