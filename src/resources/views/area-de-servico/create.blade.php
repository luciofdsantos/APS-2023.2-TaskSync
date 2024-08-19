<x-layout>
    <a class="btn btn-secondary" href="{{ route('area-de-servico.index') }}">Voltar</a>
    <form method="post" action="{{ route('area-de-servico.store') }}" class="form-control">
        @csrf

        <label for="nome">Nome</label>
        <input type="text" name="nome" value={{ old('nome') }}>
        @error('nome')
            <div class="error-message">
                <i>&#9888;</i> <!-- Ícone de alerta -->
                {{ $message }}
            </div>
        @enderror
        <label for="gerente_id">Gerente responsável</label>
        <select class="form-control" name="gerente_id" value="0">
            @foreach ($gerentes as $gerente)
                <option value="{{ $gerente['id'] }}">{{ $gerente->user->name . ' - ' . $gerente->cpf }}</option>
            @endforeach
        </select>
        @error('gerente_id')
            <div class="error-message">
                <i>&#9888;</i> <!-- Ícone de alerta -->
                {{ $message }}
            </div>
        @enderror
        <br>

        <label>Funcionários</label>
        <x-listbox :availableItems="$funcionarios" :selectedItems="[]" />
        @error('selectedItems')
            <div class="error-message">
                <i>&#9888;</i> <!-- Ícone de alerta -->
                {{ $message }}
            </div>
        @enderror

        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</x-layout>
