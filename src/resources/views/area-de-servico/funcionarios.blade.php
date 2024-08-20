<div class="card">
    <div class="card-body">
        <form method="post"
            action="{{ route('area-de-servico.adiciona-funcionario', [
                'area_de_servico' => $area_de_servico,
                'tarefa' => $tarefa,
            ]) }}">
            @csrf
            <div class="form-check">
                @foreach ($funcionarios as $funcionario)
                    <input class="form-check-input" name="funcionarios[]" type="checkbox" value="{{ $funcionario->id }}"
                        id="{{ $funcionario->id }}">
                    <label class="form-check-label" for="funcionarios[]">
                        {{ $funcionario->user->name }}
                    </label>
                @endforeach
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
    </div>
</div>
