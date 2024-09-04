<!doctype html>
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
                <h1 style="color: #717171;">Editar Área de Serviço</h1>
                <form method="post" action="{{ route('area-de-servico.update', ['area_de_servico' => $area_de_servico]) }}"
                    class="">
                    @csrf
                    @method('put')
                    
                    <div class="form-row">
                        <div>
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" value={{ $area_de_servico->nome }} class="form-control">
                            @error('nome')
                                <div class="error-message">
                                    <i>&#9888;</i> <!-- Ícone de alerta -->
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="gerente_id">Gerente responsável</label>
                            <select class="form-control" name="gerente_id" value="{{ $area_de_servico->gerente_id }}" style="border-radius: 15px;">
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
                        </div>
                    </div>

                    <label>Funcionários</label>
                    <x-listbox :availableItems="$funcionarios" :selectedItems="$selected_funcionarios" />
                    @error('selectedItems')
                        <div class="error-message">
                            <i>&#9888;</i> <!-- Ícone de alerta -->
                            {{ $message }}
                        </div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </main>
    </div>
    <x-item-layout/>
<body>

<script>
    const toSelect = document.getElementById('selected');
    const optionElements = toSelect.getElementsByTagName('option');
    const optionsArray = Array.from(toSelect.options);

    optionsArray.forEach(element => {
        element.selected = true
    });

</script>
</html>