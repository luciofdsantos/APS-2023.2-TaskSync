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
                <h1>Solicitação</h1>
                <div style="display: flex; align-items; ">
                <a href="{{ route('solicitacoes.index') }}" class="btn btn-secondary">Voltar</a>

                <form method="post"
                    action="{{ route('solicitacoes.mudar-status', ['solicitacao' => $solicitacao, 'cancelar' => false]) }}"
                    onsubmit="return confirm('Deseja aceitar essa solicitação?')">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-success">Aceitar</button>
                </form>
                <br>
                <form method="post"
                    action="{{ route('solicitacoes.mudar-status', ['solicitacao' => $solicitacao, 'cancelar' => false]) }}"
                    onsubmit="return confirm('Deseja cancelar essa solicitação?')">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-warning">Cancelar</button>
                </form>
                </div>
                <table class="table">

                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 10%;">Assunto</th>
                            <th style="width: 55%;">Descrição</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 15%;">Prazo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>{{ $solicitacao->id }}</td>
                        <td>{{ $solicitacao->assunto }}</td>
                        <td>{{ Str::words($solicitacao->descricao, 50, ' . . . ') }}</td>
                        <td>{{ App\Models\Solicitacao\StatusSolicitacao::get($solicitacao->status) }}</td>
                        <td>{{ \Carbon\Carbon::parse($solicitacao->prazo)->format('d/m/Y') ?? 'Não definido' }}</td>

                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <x-item-layout/>
</body>
