<x-layout>
<h1>Solicitações</h1>

<a href="{{ route('solicitacoes.create') }}" class="btn btn-primary">Solicitar Serviço</a>

@if ($message = Session::get('success'))
    <div class="alert alert-success">{{ $message }}</div>
@endif

<ul>
    @foreach ($solicitacoes as $solicitacao)
        <li>
            <a href="{{ route('solicitacoes.edit', $solicitacao->id) }}">{{ $solicitacao->assunto }}</a>
            <span>Status: {{ $solicitacao->status }}</span>
            <form action="{{ route('solicitacoes.destroy', $solicitacao->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button id="cancelarSolicitacao" type="submit" class="btn btn-danger">Cancelar</button>
            </form>
        </li>
    @endforeach
</ul>

<script>
        // Função que esconde o botão após determinado tempo
        function esconderBotao() {
            const botao = document.getElementById('cancelarSolicitacao');

            // Define o tempo para esconder o botão
            setTimeout(() => {
                botao.style.display = 'none';
            }, 30000); // 30000 milissegundos = 30 segundos
        }

        // Esconde o botão quando a página carrega
        window.onload = esconderBotao;
    </script>
</x-layout>