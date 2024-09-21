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
                <h2 style="color: #717171;">Relatório</h2>

                <div class="cardy">
                    <div class="card-body">
                        <form method="post" action="{{ route('relatorios.buscaSolicitacoesClientes') }}">
                            @csrf
                            <label for="nome">Clientes:</label>
                            <select class="form-control" style="border-radius: 15px;" name="cliente_id">
                                <option value="" selected></option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">
                                        {{ $cliente->user->name }}</option>
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
                                <th>Nome</th>
                                <th>Assunto</th>
                                <th>Descrição</th>
                                <th>Prazo</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itens as $item)
                                <tr>
                                    <td style="width: 5%;">{{ $item->id }}</td>
                                    <td style="width: 5%;">{{ $item->nome }}</td>
                                    <td style="width: 5%;">{{ $item->assunto }}</td>
                                    <td style="width: 5%;">{{ $item->descricao }}</td>
                                    <td style="width: 5%;">{{ $item->prazo ?? 'Não definido' }}</td>
                                    <td style="width: 5%;">
                                        {{ App\Models\Solicitacao\StatusSolicitacao::get($item->status) }}</td>
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
