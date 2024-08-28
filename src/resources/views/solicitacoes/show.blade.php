<x-layout>

    <a href="{{ route('solicitacoes.index') }}" class="btn btn-secondary">Voltar</a>

    <form method="post"
        action="{{ route('solicitacoes.mudar-status', ['solicitacao' => $solicitacao, 'cancelar' => true]) }}"
        onsubmit="return confirm('Deseja cancelar essa solicitação')">
        @csrf
        @method('PUT')
        <button class="btn btn-success">Aceitar</button>
    </form>
    <br>
    <form method="post"
        action="{{ route('solicitacoes.mudar-status', ['solicitacao' => $solicitacao, 'cancelar' => false]) }}"
        onsubmit="return confirm('Deseja aceitar essa solicitação')">
        @csrf
        @method('PUT')
        <button class="btn btn-warning">Cancelar</button>
    </form>

    <table>
        <tr>
            <td class="bold">ID:</td>
            <td>{{ $solicitacao->id }}</td>
        </tr>
        <tr>
            <td class="bold">Assunto:</td>
            <td>{{ $solicitacao->assunto }}</td>
        </tr>
        <tr>
            <td class="bold">Descrição:</td>
            <td>{{ $solicitacao->descricao }}</td>
        </tr>
        <tr>
            <td class="bold">Prazo:</td>
            <td>{{ $solicitacao->prazo }}</td>
        </tr>
        <tr>
            <td class="bold">Status:</td>
            <td>{{ App\Models\Solicitacao\StatusSolicitacao::get($solicitacao->status) }}</td>
        </tr>
    </table>
</x-layout>
