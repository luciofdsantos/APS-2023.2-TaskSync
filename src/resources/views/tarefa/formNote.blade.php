<h1>Criar Nota</h1>
<form action="{{route('tarefa.storeNote', ['id' => $tarefa->id]) }}" method="POST">
    @csrf
    <label for="descricao">Descrição:</label>
    <textarea class="form-control" id="descricao" name="descricao" required></textarea>
    @error('descricao')
        <div class="error-message">
            <i>&#9888;</i> <!-- Ícone de alerta -->
            {{ $message }}
        </div>
    @enderror
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
