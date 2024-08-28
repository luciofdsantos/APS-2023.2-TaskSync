<x-layout>

    @php
        $data = new DateTime();
        $data = $data->format('Y-m-d');
    @endphp

    <h1>Nova Solicitação</h1>
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

    <form action="{{ route('solicitacoes.store') }}" method="POST">
        @csrf
        <label for="assunto">Assunto*</label>
        <input type="text" name="assunto" value="{{ old('assunto') }}" required>

        <label for="descricao">Descrição do Serviço Solicitado*</label>
        <textarea name="descricao" required>{{ old('descricao') }}</textarea>

        <label for="categoria">Categoria*</label>
        <input type="text" name="categoria" value="{{ old('categoria') }}" required>

        <label for="prazo">Prazo</label>
        <input type="date" name="prazo" value="{{ old('prazo') }}" min={{ $data }}>

        <button type="submit" class="btn btn-primary">Enviar Solicitação</button>
    </form>

</x-layout>
