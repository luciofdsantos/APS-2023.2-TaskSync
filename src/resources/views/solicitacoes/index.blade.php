<!DOCTYPE html>
<html lang="pt">
<head>
    <x-header-layout/>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/solicitacoes.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>

<body>
    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <h1 style="color: #717171;">Solicitações</h1>
                <a href="{{ route('solicitacoes.create') }}" class="btnAdd btn">Solicitar Serviço +</a>
                <x-message />
            
                <table class="tableS" style="font-family: 'Roboto', sans-serif;">
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 20%;">Assunto</th>
                            <th style="width: 40%;">Descrição</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 10%;">Prazo</th>
                            <th style="width: 15%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($solicitacoes as $solicitacao)
                            <tr>
                                <td>{{ $solicitacao->id }}</td>
                                <td>{{ $solicitacao->assunto }}</td>
                                <td>{{ Str::words($solicitacao->descricao, 50, ' . . . ') }}</td>
                                <td>{{ App\Models\Solicitacao\StatusSolicitacao::get($solicitacao->status) }}</td>
                                <td>{{ \Carbon\Carbon::parse($solicitacao->prazo)->format('d/m/Y') ?? 'Não definido' }}</td>
                                <td class="action-icons">

                                    @if ($solicitacao->cliente_id == auth()->user()->id)
                                    <a class="btn bi bi-pencil"
                                        href="{{ route('solicitacoes.edit', ['solicitacao' => $solicitacao]) }}"></a>
                                    <br>
                                    @endif
                                    
                                    <a class="btn bi bi-eye"
                                            href="{{ route('solicitacoes.show', ['solicitacao' => $solicitacao]) }}"></a>


                                   

                                    @can('cancelar', $solicitacao)
                                        <form method="post"
                                            action="{{ route('solicitacoes.cancelar', ['solicitacao' => $solicitacao]) }}"
                                            onsubmit="return confirm('Deseja cancelar essa solicitação')">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-warning btn-sm">Cancelar</button>
                                        </form>
                                    @endcan


                                    @can('delete', $solicitacao)
                                    <form method="post"
                                            action="{{ route('solicitacoes.destroy', ['solicitacao' => $solicitacao]) }}"
                                            style="display:inline-block;"
                                            onsubmit="return confirm('Deseja excluir esta area de serviço?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn delete-button bi bi-trash"></button>
                                        </form>
                                        @endcan
                                        {{-- @endcan --}}
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $solicitacoes->links() }}
            </div>
        </main>
    </div>
    <x-item-layout/>
</body>
