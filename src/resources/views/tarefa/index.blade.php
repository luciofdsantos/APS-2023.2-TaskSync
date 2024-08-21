<x-layout>
        <!-- <h1>Lista de Tarefas</h1>
        <a href="{{ route('tarefa.create') }}" class="btn btn-primary">Criar Tarefa</a>
        <ul>
            @foreach ($tarefas as $tarefa)
                <li>
                    <a href="{{ route('tarefa.show', $tarefa->id) }}">{{ $tarefa->nome }}</a>
                    <form action="{{ route('tarefa.destroy', $tarefa->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </li>
            @endforeach
        </ul> -->
        <h1>Gerenciar Tarefas</h1>

        <a href="{{ route('tarefa.create') }}" class="btn btn-primary">Criar Tarefa</a>

            <ul>
                @foreach ($tarefas as $tarefa)
                    <li>
                    <a href="{{ route('tarefa.show', $tarefa->id) }}">{{ $tarefa->title }}</a>
                        <a href="{{ route('tarefa.edit', $tarefa->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('tarefa.destroy', $tarefa->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </li>
                @endforeach
            </ul>
</x-layout>