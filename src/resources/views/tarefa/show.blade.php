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
                {{-- <h1>{{ $tarefa->titulo }}</h1>
                <p>Descrição: {{ $tarefa->descricao }}</p>
                <p>Prazo: {{ $tarefa->deadline }}</p> --}}
                @if (app('request')->input('url'))
                    <a href="{{ app('request')->input('url') }}" class="btn btn-secondary">Voltar</a>
                @else
                    <a href="{{ route('tarefa.index') }}" class="btn btn-secondary">Voltar</a>
                @endif

                <form method="post" action="{{ route('tarefa.destroy', ['tarefa' => $tarefa]) }}"
                    onsubmit="return confirm('Deseja excluir esta tarefa?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Deletar</button>
                </form>

                <table class="table">

                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 10%;">Título</th>
                            <th style="width: 55%;">Descrição</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 10%;">Adicionar Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>{{ $tarefa->id }}</td>
                        <td>{{ $tarefa->titulo }}</td>
                        <td>{{ $tarefa->descricao }}</td>
                        <td>{{ App\Models\Tarefa\StatusTarefa::get($tarefa->status) }}</td>
                        <td class="action-icons">
                                <a class="btn bi bi-pencil" href="{{ route('tarefa.add_note_form', ['id' => $tarefa->id]) }}"></a>
                                <a class="btn bi bi-eye" onclick="toggleNotas({{ $tarefa->id }})"></a>
                            </td>

                            <tr id="notas-{{ $tarefa->id }}" style="display: none;">
                                <td colspan="5">
                                    <ul>
                                        @foreach ($tarefa->notas as $nota)
                                            <li>{{ $nota->description }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>

                        <!-- @include('tarefa.formNote',['tarefaId' => $tarefa->id])
                        @if ($tarefa->notas->isNotEmpty())
                            <h3>Notas da Tarefa</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Descrição</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tarefa->notas as $nota)
                                        <tr>
                                            <td>{{ $nota->id }}</td>
                                            <td>{{ $nota->description }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Não há notas associadas a esta tarefa.</p>
                        @endif

                        </td> -->
                    </tbody>
                </table>
    <x-item-layout/>
</body>

<script>
    function toggleNotas(tarefaId) {
        var notasRow = document.getElementById('notas-' + tarefaId);
        if (notasRow.style.display === 'none') {
            notasRow.style.display = '';
        } else {
            notasRow.style.display = 'none';
        }
    }
</script>

