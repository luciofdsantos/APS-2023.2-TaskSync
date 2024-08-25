<x-layout>
    @can('create', 'App\Models\AreaDeServico\AreaDeServico')
        <a href="{{ route('area-de-servico.create') }}" class="btn btn-success" role="button">Criar</a>
    @endcan

    <div class="card">
        <div class="card-body">
            <table>
                <th>Id</th>
                <th>Nome</th>
                <th>Gerente</th>
                <th>
                    @foreach ($areas_de_servico as $area_de_servico)
                        <tr>
                            <td>{{ $area_de_servico->id }}</td>
                            <td>{{ $area_de_servico->nome }}</td>
                            <td>{{ $area_de_servico->gerente->user->name ?? '' }}</td>
                            <td>
                                @can('update', $area_de_servico)
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('area-de-servico.edit', ['area_de_servico' => $area_de_servico]) }}">Editar</a>
                                    <br>
                                @endcan

                                <a class="btn btn-info btn-sm"
                                    href="{{ route('area-de-servico.show', ['area_de_servico' => $area_de_servico['id']]) }}">Visualizar</a>
                                @can('delete', $area_de_servico)
                                    <form method="post"
                                        action="{{ route('area-de-servico.destroy', ['area_de_servico' => $area_de_servico]) }}"
                                        onsubmit="return confirm('Deseja excluir esta area de serviço?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Deletar</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
            </table>
            {{ $areas_de_servico->links() }}
        </div>
    </div>

</x-layout>
