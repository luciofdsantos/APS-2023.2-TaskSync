<?php

namespace App\Http\Controllers;

use App\Models\Tarefa\Prioridade;
use App\Models\Tarefa\Tarefa;
use Illuminate\Http\Request;

class FullCalendarController extends Controller
{
    public function index()
    {
        return view('full-calendar.master');
    }

    public function get(Request $request)
    {
        // dd($request);
        $tarefas = Tarefa::all();

        $data = [];

        foreach ($tarefas as $tarefa) {
            $data[] = [
                'id' => $tarefa->id,
                'title' => $tarefa->titulo,
                'start' => $tarefa->prazo,
                'color' => Prioridade::getCor($tarefa->prioridade),
                'textColor' => 'white',
            ];
        }
        // dd($data);

        return response()->json($data);
    }
}
