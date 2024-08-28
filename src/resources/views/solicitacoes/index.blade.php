<x-layout>
    <h1>Solicitações</h1>

    <a href="{{ route('solicitacoes.create') }}" class="btn btn-success">Solicitar Serviço</a>

    <x-message />

    <table>
        <th style="width: 5%;">ID</th>
        <th style="width: 10%;">Assunto</th>
        <th style="width: 55%;">Descrição</th>
        <th style="width: 10%;">Status</th>
        <th style="width: 15%;">Prazo</th>
        <th>Ações</th>
        <th>
            @foreach ($solicitacoes as $solicitacao)
                <tr>
                    <td>{{ $solicitacao->id }}</td>
                    <td>{{ $solicitacao->assunto }}</td>
                    <td>{{ Str::words($solicitacao->descricao, 50, ' . . . ') }}</td>
                    <td>{{ App\Models\Solicitacao\StatusSolicitacao::get($solicitacao->status) }}</td>
                    <td>{{ \Carbon\Carbon::parse($solicitacao->prazo)->format('d/m/Y') ?? 'Não definido' }}</td>
                    <td>
                        <a class="btn btn-secondary btn-sm"
                            href="{{ route('solicitacoes.show', ['solicitacao' => $solicitacao]) }}">Visualizar</a>
                        <br>

                        @if ($solicitacao->cliente_id == auth()->user()->id)
                            <a class="btn btn-primary btn-sm"
                                href="{{ route('solicitacoes.edit', ['solicitacao' => $solicitacao]) }}">Editar</a>
                            <br>
                        @endif

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
                                onsubmit="return confirm('Deseja excluir esta area de serviço?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Deletar</button>
                            </form>
                        @endcan
                        {{-- @endcan --}}
                    </td>
                </tr>
            @endforeach
    </table>
    {{ $solicitacoes->links() }}
</x-layout>
