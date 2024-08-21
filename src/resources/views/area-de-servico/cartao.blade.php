<div class="task card w-75" draggable="true" value="{{ $tarefa->id }}">
    <p> Nome: {{ $tarefa->nome }} </p>
    <p> Descrição: {{ $tarefa->descricao }} </p>
    <p> Funcionarios: </p>
    @foreach ($tarefa->funcionarios as $funcionario)
        {{ $funcionario->user->name }}
    @endforeach
    <button type="button" data-bs-toggle="modal" data-bs-target="#funcionarios-form" class="btn badge bg-primary"
        data-url="{{ route('area-de-servico.adiciona-funcionario', ['area_de_servico' => $area_de_servico, 'tarefa' => $tarefa]) }}"
        data-tarefa="{{ $tarefa->id }}">+
        Funcionários</button>
    <a href="{{ route('tarefa.destroy', ['tarefa' => $tarefa]) }}" class="btn badge bg-danger">Apagar</a>
</div>
