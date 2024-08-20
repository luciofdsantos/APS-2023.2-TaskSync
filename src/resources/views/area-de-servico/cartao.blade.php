<div class="task card w-75" draggable="true" value="{{ $tarefa->id }}">
    <p> Nome: {{ $tarefa->nome }} </p>
    <p> Descrição: {{ $tarefa->descricao }} </p>
    <p> Funcionarios: </p>
    @foreach ($tarefa->funcionarios as $funcionario)
        {{ $funcionario->user->name }}
    @endforeach
    <a href="#" class="btn badge bg-success">+ Funcionario</a>
    <a href="#" class="btn badge bg-info">Detalhes</a>
</div>
