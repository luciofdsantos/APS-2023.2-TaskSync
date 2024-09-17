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
                <h1 style="color: #717171;">Relatório</h1>

                <div class="cardy">
                    <div class="card-body">
                        <form method="post" action="{{ route('relatorios.buscaTarefasFuncionarios') }}">
                            @csrf
                            <label for="nome">Funcionários:</label>
                            <select class="form-control" style="border-radius: 15px;" name="funcionario_id">
                                <option value="" selected></option>
                                @foreach ($funcionarios as $funcionario)
                                    <option value="{{ $funcionario->id }}">
                                        {{ $funcionario->user->name }}</option>
                                @endforeach
                            </select>

                            @error('nome')
                                <div class="error-message">
                                    <i>&#9888;</i> <!-- Ícone de alerta -->
                                    {{ $message }}
                                </div>
                            @enderror

                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </form>
                    </div>
                </div>

                @if (isset($itens))
                    <table class="tableT">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tarefa</th>
                                <th>Descrição</th>
                                <th>Funcionário</th>
                                <th>Prazo</th>
                                <th>Status</th>
                                <th>Conclusão</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itens as $item)
                                <tr>
                                    <td style="width: 5%;">{{ $item->id }}</td>
                                    <td style="width: 20%;">{{ $item->tarefa_nome }}</td>
                                    <td style="width: 20%;">{{ $item->tarefa_descricao }}</td>
                                    <td style="width: 20%;">{{ $item->nome }}</td>
                                    <td style="width: 20%;">{{ $item->prazo }}</td>
                                    <td style="width: 20%;">{{ App\Models\Tarefa\StatusTarefa::get($item->status) }}
                                    </td>
                                    <td style="width: 20%;">{{ $item->conclusao ?? 'Não concluído' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </main>
    </div>
    <x-item-layout />
</body>
