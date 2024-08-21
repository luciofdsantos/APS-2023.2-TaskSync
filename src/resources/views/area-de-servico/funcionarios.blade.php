<div class="card">
    <div class="card-body">
        <form method="post"
            action="{{ route('area-de-servico.salva-funcionario', [
                'area_de_servico' => $area_de_servico,
            ]) }}">
            @csrf
            <div class="form-check">
                @foreach ($funcionarios as $funcionario)
                    <input class="opcao form-check-input" name="funcionarios[]" type="checkbox"
                        value="{{ $funcionario->id }}" id="{{ $funcionario->id }}">
                    <label class="form-check-label" for="funcionarios[]">
                        {{ $funcionario->user->name }}
                    </label>
                @endforeach
            </div>
            <input type="hidden" id="tarefa_id" name="tarefa_id" value="">
            <button type="submit" class="btn btn-success">Salvar</button>
        </form>
    </div>
</div>