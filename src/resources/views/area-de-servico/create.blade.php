<!DOCTYPE html>
<html lang="pt">
<head>
    <x-header-layout/>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>
<body>
    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <a class="btn btn-secondary" href="{{ route('area-de-servico.index') }}">Voltar</a>
                <form method="post" action="{{ route('area-de-servico.store') }}" class="form-control">
                    @csrf

                    <label for="nome">Nome</label>
                    <input class="form-control" type="text" name="nome" value={{ old('nome') }}>
                    @error('nome')
                        <div class="error-message">
                            <i>&#9888;</i> <!-- Ícone de alerta -->
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="gerente_id">Gerente responsável</label>
                    <select class="form-control" class="form-control" name="gerente_id" value="0">
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
                    <x-listbox :availableItems="$funcionarios" :selectedItems="[]" class="form-control"/>
                    @error('selectedItems')
                        <div class="error-message">
                            <i>&#9888;</i> <!-- Ícone de alerta -->
                            {{ $message }}
                        </div>
                    @enderror

                    <button type="submit" class="btn btn-success">Salvar</button>
                </form>
            </div>
        </main>
    </div>
    <x-item-layout/>
</body>
