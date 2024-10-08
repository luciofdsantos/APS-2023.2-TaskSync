<!DOCTYPE html>
<html lang="pt">

<head>
    <x-header-layout />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tarefa.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>

<body>

    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <x-message />
                <h1 style="color: #717171;">Gerenciar Tarefas</h1>

                <div class="cardy">
                    <div class="card-body">
                        <table class="tableT">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Título</th>
                                    <th>Descrição</th>
                                    <th>Prazo</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tarefas as $tarefa)
                                    <tr>
                                        <td style="width: 5%;">{{ $tarefa->id }}</td>
                                        <td style="width: 20%;">{{ $tarefa->titulo }}</td>
                                        <td style="width: 40%;">{{ $tarefa->descricao }}</td>
                                        <td style="width: 20%;"> {{ $tarefa->prazo }}</td>
                                        <td style="width: 15%;" class="action-icons">
                                            @can('editar', 'App\Models\Tarefa\Tarefa')
                                                <a class="btn bi bi-pencil"
                                                    href="{{ route('tarefa.edit', ['tarefa' => $tarefa]) }}""></a>
                                            @endcan
                                            <a class="btn bi bi-eye"
                                                href="{{ route('tarefa.show', ['tarefa' => $tarefa]) }}"></a>
                                            @can('editar', 'App\Models\Tarefa\Tarefa')
                                                <form method="post"
                                                    action="{{ route('tarefa.destroy', ['tarefa' => $tarefa]) }}"
                                                    onsubmit="return confirm('Deseja excluir esta tarefa?')"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn bi bi-trash"></button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $tarefas->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>
    <x-item-layout />
</body>
