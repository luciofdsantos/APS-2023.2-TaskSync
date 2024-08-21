<x-layout>
        <h1>Editar Tarefa</h1>

        <!-- Mensagem de  Erro-->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
         @endif

        <form action="{{ route('tarefa.update', $tarefa->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $tarefa->titulo }}" required>
                @error('titulo')
                <div class="error-message">
                    <i>&#9888;</i> <!-- Ícone de alerta -->
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" id="descricao" name="descricao" required>{{ $tarefa->descricao }}</textarea>
                @error('descricao')
                <div class="error-message">
                    <i>&#9888;</i> <!-- Ícone de alerta -->
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="deadline">Prazo:</label>
                <input type="text" class="form-control" id="deadline" name="deadline" value="{{ $tarefa->deadline }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
</x-layout>