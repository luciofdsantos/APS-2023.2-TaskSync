<h3>Funcionários:</h3>
<form method="post" action="{{ route('area-de-servico.salva-funcionario', ['area_de_servico' => $area_de_servico]) }}">
    @csrf
    <table class="table-custom">
        <thead>
            <tr>
                <th></th>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($funcionarios as $funcionario)
                <tr>
                    <td>
                        <input class="form-check-input" name="funcionarios[]" type="checkbox" value="{{ $funcionario->id }}" id="funcionario_{{ $funcionario->id }}">
                    </td>
                    <td>
                        <label class="form-check-label" for="funcionario_{{ $funcionario->id }}">
                            {{ $funcionario->user->name }}
                        </label>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <input type="hidden" id="tarefa_id" name="tarefa_id" value="">
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>

<style>
    .table-custom {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        color: #333;
    }

    .table-custom th, .table-custom td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table-custom thead {
        background-color: #0062FF;
        border-bottom: 2px solid #ddd;
    }

    .table-custom tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table-custom th {
        font-weight: bold;
    }
</style>
