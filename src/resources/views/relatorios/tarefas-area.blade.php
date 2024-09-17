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
                        <form method="post" action="{{ route('relatorios.buscaTarefasArea') }}">
                            @csrf
                            <label for="nome">Area De Serviço:</label>
                            <select class="form-control" style="border-radius: 15px;" name="area_de_servico_id"
                                value="0">
                                <option value="" selected></option>
                                @foreach ($areas_de_servico as $area_de_servico)
                                    <option value="{{ $area_de_servico->id }}">
                                        {{ $area_de_servico->nome }}</option>
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

                @if (isset($tarefas))
                    <table class="tableT">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Título</th>
                                <th>Descrição</th>
                                <th>Funcionários</th>
                                <th>Status</th>
                                <th>Prazo</th>
                                <th>Data de Conclusão</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tarefas as $tarefa)
                                <tr>
                                    <td style="width: 5%;">{{ $tarefa->id }}</td>
                                    <td style="width: 20%;">{{ $tarefa->titulo }}</td>
                                    <td style="width: 35%;">{{ $tarefa->descricao }}</td>
                                    <td style="width: 20%;">
                                        <ul>
                                            @foreach ($tarefa->funcionarios as $funcionario)
                                                <li>{{ $funcionario->user->name }} </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td style="width: 10;">{{ App\Models\Tarefa\StatusTarefa::get($tarefa->status) }}
                                    </td>
                                    <td style="width: 20%;"> {{ $tarefa->prazo }}</td>
                                    <td style="width: 20%;"> {{ $tarefa->data_conclusao ?? 'Não concluída' }}</td>
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
