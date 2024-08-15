<x-layout>

    <a class="btn btn-secondary" href="{{ route('/usuario') }}">Voltar</a>

    <table>
        <tr>
            <td>Nome:</td>
            <td>{{ $usuario->users->name }}</td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>{{ $usuario->users->email }}</td>
        </tr>
        <tr>
            <td>Data de Nascimento:</td>
            <td>{{ $usuario->data_nascimento }}</td>
        </tr>
        <tr>
            <td>CPF:</td>
            <td>{{ $usuario->cpf }}</td>
        </tr>
    </table>
</x-layout>
