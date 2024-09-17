<!doctype html>
<html lang="pt">

<head>
    <x-header-layout />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body>
    <div class="content-container">

        <main class="main-cntt">
            <div class="content-box">
                <h2> Criar Equipe</h2>

                <div class="table-responsive">
                    <form method="post" class="form-control" action="{{ route('equipe.store') }}">
                        <div class=".userForm">
                            @csrf
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" value='{{ old('name') }}' required
                                class="form-control">

                            @error('nome')
                                <div class="error-message">
                                    <i>&#9888;</i> <!-- Ícone de alerta -->
                                    {{ $message }}
                                </div>
                            @enderror

                            <label for="descricao">Descrição</label>
                            <textarea type="text" name="descricao" required class="form-control">{{ old('descricao') }}</textarea>
                            @error('descricao')
                                <div class="error-message">
                                    <i>&#9888;</i> <!-- Ícone de alerta -->
                                    {{ $message }}
                                </div>
                            @enderror

                            <label>Funcionarios</label><br>
                            <x-listbox :availableItems="$funcionarios" :selectedItems="[]" class="form-control" />
                            @error('selectedItems')
                                <div class="error-message">
                                    <i>&#9888;</i> <!-- Ícone de alerta -->
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-success">Salvar</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <x-item-layout />
</body>

</html>
