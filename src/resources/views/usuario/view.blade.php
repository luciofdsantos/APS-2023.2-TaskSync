<x-layout>

    <a class="btn btn-secondary" href="{{ route('/usuario') }}">Voltar</a>

    <table>
        <tr>
            <td class="bold">Nome:</td>
            <td>{{ $usuario->user->name }}</td>
        </tr>
        <tr>
            <td class="bold">Email:</td>
            <td>{{ $usuario->user->email }}</td>
        </tr>
        <tr>
            <td class="bold">Data de Nascimento:</td>
            <td>{{ $usuario->data_nascimento }}</td>
        </tr>
        <tr>
            <td class="bold">CPF:</td>
            <td>{{ $usuario->cpf }}</td>
        </tr>
        <tr>
            <td class="bold">Rua:</td>
            <td>{{ $usuario->rua }}</td>
        </tr>
        <tr>
            <td class="bold">Número:</td>
            <td>{{ $usuario->numero }}</td>
        </tr>
        <tr>
            <td class="bold">Bairro:</td>
            <td>{{ $usuario->bairro }}</td>
        </tr>
        <tr>
            <td class="bold">CEP:</td>
            <td>{{ $usuario->cep }}</td>
        </tr>
        <tr>
            <td class="bold">Tipo de Usuario:</td>
            <td>{{ App\Models\Usuario\TipoUsuario::getAll()[$usuario->tipo_usuario] }}</td>
        </tr>
    </table>
</x-layout>
