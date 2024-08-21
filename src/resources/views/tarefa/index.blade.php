<x-layout>
    <h1>Gerenciar Tarefas</h1>

    <div class="card">
        <div class="card-body">
            <table>
                <th>Id</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Prazo</th>
                <th>Ações
                <th>
                    @foreach ($tarefas as $tarefa)
                        <tr>
                            <td>{{ $tarefa->id }}</td>
                            <td>{{ $tarefa->titulo }}</td>
                            <td>{{ $tarefa->descricao }}</td>
                            <td> {{ $tarefa->prazo }}</td>
                            <td>

                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('tarefa.edit', ['tarefa' => $tarefa]) }}">Editar</a>
                                <br>

                                <a class="btn btn-info btn-sm"
                                    href="{{ route('tarefa.show', ['tarefa' => $tarefa]) }}">Visualizar</a>
                                <form method="post" action="{{ route('tarefa.destroy', ['tarefa' => $tarefa]) }}"
                                    onsubmit="return confirm('Deseja excluir esta tarefa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
            </table>
            {{ $tarefas->links() }}
        </div>
    </div>
</x-layout>
