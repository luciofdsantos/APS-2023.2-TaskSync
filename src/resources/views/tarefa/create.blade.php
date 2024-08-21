<x-layout>
        <h1>Criar Tarefa</h1>

        <form action="{{ route('tarefa.store') }}" method="POST">
            @csrf
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
                @error('titulo')
                <div class="error-message">
                    <i>&#9888;</i> <!-- Ícone de alerta -->
                    {{ $message }}
                </div>
                @enderror
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" id="descricao" name="descricao" required></textarea>
                @error('descricao')
                <div class="error-message">
                    <i>&#9888;</i> <!-- Ícone de alerta -->
                    {{ $message }}
                </div>
                @enderror
                <label for="deadline">Prazo:</label>
                <input type="date" class="form-control" id="deadline" name="deadline">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
 </x-layout>
