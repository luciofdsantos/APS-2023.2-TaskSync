@php
    $data = new DateTime();
    $data = $data->format('Y-m-d');
@endphp
<x-layout>
    <h1>Editar Solicitação</h1>
    <a href="{{ route('solicitacoes.index') }}" class="btn btn-secondary">Voltar</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('solicitacoes.update', $solicitacao->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="assunto">Assunto*</label>
        <input type="text" name="assunto" value="{{ $solicitacao->assunto }}" required>

        <label for="descricao">Descrição do Serviço Solicitado*</label>
        <textarea name="descricao" required>{{ $solicitacao->descricao }}</textarea>

        <label for="categoria">Categoria*</label>
        <input type="text" name="categoria" value="{{ $solicitacao->categoria }}" required>

        <label for="prazo">Prazo</label>
        <input type="date" name="prazo" value="{{ $solicitacao->prazo }}" min={{ $data }}>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</x-layout>
