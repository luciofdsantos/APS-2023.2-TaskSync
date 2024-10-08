<?php

use App\Http\Controllers\AreaDeServicoController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\SolicitacaoController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\RelatoriosController;
use App\Http\Controllers\SiteController;
use App\Models\AreaDeServico;
use App\Models\Equipe;
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
        // Route::get('/usuario/{id}', 'view')->name('usuario.view');
        Route::get('/usuario/update/{usuario}', 'update')->name("usuario.update");
        Route::put('/usuario/update/{usuario}', 'atualizar')->name("usuario.update");
        Route::delete('/usuario/delete/{usuario}', 'destroy')->name('usuario.destroy');
    }
);

// AREA DE SERVIÇO

Route::get('/area-de-servico/{area_de_servico}/equipe', [AreaDeServicoController::class, 'equipe'])
    ->middleware('auth')
    ->name("area-de-servico.equipe");

Route::get('/area-de-servico/{area_de_servico}/equipe/{equipe}', [AreaDeServicoController::class, 'addEquipe'])
    ->middleware('auth')
    ->name("area-de-servico.add-equipe");

Route::get('/area-de-servico/{area_de_servico}/equipe/{equipe}/del', [AreaDeServicoController::class, 'delEquipe'])
    ->middleware('auth')
    ->name("area-de-servico.del-equipe");

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


// EQUIPE

Route::resource('equipe', EquipeController::class)->middleware('auth');

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

        // Alterar status
        Route::post('/tarefa/{id}/update-status', [TarefaController::class, 'updateStatus'])->name('tarefa.updateStatus');

        //Adicionar Notas
        Route::get('/tarefa/{id}/form-note', [TarefaController::class, 'addNoteForm'])->name('tarefa.formNote');
        Route::post('/tarefa/{id}/store-note', [TarefaController::class, 'storeNote'])->name('tarefa.storeNote');

        // Mostrar Notas
        Route::get('/tarefa/{id}/notas', [TarefaController::class, 'showNotas'])->name('tarefa.notas');

        //Excluir Notas
        Route::delete('/nota/{id}', [TarefaController::class, 'destroyNote'])->name('nota.destroy');
    }
);

// Solicitacao
Route::controller(SolicitacaoController::class)->middleware('auth')->group(
    function () {
        //Listar Solicitações
        Route::get('/solicitacoes', 'index')->name('solicitacoes.index'); // Listagem de solicitações

        // Criar Solicitacao e Salvar
        Route::get('/solicitacoes-create', 'create')->name('solicitacoes.create');
        Route::post('/solicitacoes', 'store')->name("solicitacoes.store");

        // Editar Solicitacao
        Route::get('/solicitacoes/{solicitacao}/edit', 'edit')->name('solicitacoes.edit');
        Route::put('/solicitacoes/{solicitacao}', 'update')->name('solicitacoes.update');

        // Cancelar Solicitacao
        Route::put('/solicitacoes/{solicitacao}/cancelar', 'cancelar')->name("solicitacoes.cancelar");

        // Mudar Status
        Route::put('/solicitacoes/{solicitacao}/mudar-status/{cancelar?}', 'mudarStatus')->name("solicitacoes.mudar-status");

        // Visualizar Solicitacao
        Route::get('/solicitacoes/{solicitacao}', 'show')->name("solicitacoes.show");

        //Apagar Solicitacao
        Route::delete('/solicitacoes/{solicitacao}', 'destroy')->name("solicitacoes.destroy");
    }
);


//Full Calendar
Route::controller(FullCalendarController::class)->middleware('auth')->group(
    function () {
        Route::get('/calendar', 'index')->name('calendar.index');
        Route::post('/calendar', 'index')->name('calendar.index');
        Route::get('/calendar/get/{area_de_servico_id?}', 'get')->name('calendar.get');
    }
);


Route::controller(RelatoriosController::class)->middleware('auth')->group(

    function () {
        Route::get('/reports', 'index')->name('relatorios.index');

        Route::get('/reports/tarefas-area', 'tarefasArea')->name('relatorios.tarefasArea');
        Route::post('/reports/tarefas-area', 'buscaTarefasArea')->name('relatorios.buscaTarefasArea');

        Route::get('/reports/funcionarios', 'funcionarios')->name('relatorios.funcionarios');
        Route::post('/reports/funcionarios', 'buscaTarefasFuncionarios')->name('relatorios.buscaTarefasFuncionarios');

        Route::get('/reports/clientes', 'clientes')->name('relatorios.clientes');
        Route::post('/reports/clientes', 'buscaSolicitacoesClientes')->name('relatorios.buscaSolicitacoesClientes');
    }
);

// HOME
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [SiteController::class, 'dashboard'])->middleware('auth')->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
