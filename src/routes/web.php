<?php

use App\Http\Controllers\AreaDeServicoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TarefaController;
use App\Models\AreaDeServico;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// USUARIO
Route::controller(UsuarioController::class)->middleware('auth')->group(
    function () {
        Route::get('/usuario', 'index')->name('/usuario');
        Route::get('/usuario-create', 'create')->name("usuario.create");
        Route::post('/usuario-create', 'salvar')->name("usuario.create");
        Route::get('/usuario/{id}', 'view')->name('usuario.view');
        Route::get('/usuario/update/{usuario}', 'update')->name("usuario.update");
        Route::put('/usuario/update/{usuario}', 'atualizar')->name("usuario.update");
        Route::delete('/usuario/delete/{usuario}', 'destroy')->name('usuario.destroy');
    }
);

// AREA DE SERVIÇO

Route::post('/area-de-servico/{area_de_servico}', [AreaDeServicoController::class, 'modifica'])
    ->middleware('auth')
    ->name("area-de-servico.modifica");

Route::post(
    '/area-de-servico/{area_de_servico}/adiciona-funcionario',
    [AreaDeServicoController::class, 'salvaFuncionario']
)->middleware('auth')->name("area-de-servico.salva-funcionario");

Route::get(
    '/area-de-servico/{area_de_servico}/adiciona-funcionario/{tarefa}',
    [AreaDeServicoController::class, 'adicionaFuncionario']
)->middleware('auth')->name("area-de-servico.adiciona-funcionario");

Route::resource('area-de-servico', AreaDeServicoController::class)->middleware('auth');

// TAREFA
Route::controller(TarefaController::class)->middleware('auth')->group(
    function () {
        //Listar Tarefas
        Route::get('/tarefa', 'index')->name('tarefa.index'); // Listagem de tarefas

        // Criar Tarefa
        Route::get('/tarefa/create/{area_de_servico?}', 'create')->name('tarefa.create');
        Route::post('/tarefa', 'store')->name("tarefa.store");

        // Editar Tarefa
        Route::get('/tarefa/{tarefa}/edit', 'edit')->name('tarefa.edit');
        Route::put('/tarefa/{tarefa}', 'update')->name("tarefa.update");

        // Visualizar Tarefa
        Route::get('/tarefa/{tarefa}', 'show')->name("tarefa.show");

        //Apagar Tarefa
        Route::delete('/tarefa/{tarefa}', 'destroy')->name("tarefa.destroy");
    }
);

// HOME
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
