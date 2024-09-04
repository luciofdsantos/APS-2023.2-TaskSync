<!DOCTYPE html>
<html lang="pt">
<head>
    <x-header-layout/>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>
<body>

    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <x-message/>
                {{-- <h1>Gerenciar Tarefas</h1> --}}

                <div>
                    <div>
                        <table class="table">
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
                                        <td>{{ $tarefa->id }}</td>
                                        <td>{{ $tarefa->titulo }}</td>
                                        <td>{{ $tarefa->descricao }}</td>
                                        <td> {{ $tarefa->prazo }}</td>
                                        <td class="action-icons">
                                            <a class="btn bi bi-pencil"
                                                href="{{ route('tarefa.edit', ['tarefa' => $tarefa]) }}"></a>

                                            <a class="btn bi bi-eye"
                                                href="{{ route('tarefa.show', ['tarefa' => $tarefa]) }}"></a>
                                            <form method="post" action="{{ route('tarefa.destroy', ['tarefa' => $tarefa]) }}"
                                                onsubmit="return confirm('Deseja excluir esta tarefa?')" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn bi bi-trash"></button>
                                            </form>
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
    <x-item-layout/>
</body>
