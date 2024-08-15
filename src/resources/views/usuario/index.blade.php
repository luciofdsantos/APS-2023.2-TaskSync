<x-layout>
    <a href="{{ route('usuario.create') }}" class="btn btn-success" role="button">Criar</a>
    <div class="card">
        <div class="card-body">
            <table>
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>CPF</th>
                <th>Data de Nascimento</th>
                <th>Ações
                <th>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->users->name ?? '' }}</td>
                            <td>{{ $usuario->users->email ?? '' }}</td>
                            <td> {{ $usuario->telefone }}</td>
                            <td> {{ $usuario->cpf }}</td>
                            <td>{{ $usuario->data_nascimento }}</td>
                            <td>

                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('usuario.update', ['usuario' => $usuario]) }}">Editar</a>
                                <br>

                                <a class="btn btn-info btn-sm"
                                    href="{{ route('usuario.view', ['id' => $usuario['id']]) }}">Visualizar</a>
                                <form method="post" action="{{ route('usuario.destroy', ['usuario' => $usuario]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="confirm('Deseja excluir este usuário??')">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
            </table>
            {{ $usuarios->links() }}
        </div>
    </div>
</x-layout>
