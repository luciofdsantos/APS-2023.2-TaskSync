<!doctype html>
<html lang="pt">
<head>
    <x-header-layout/>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <a href="{{ route('area-de-servico.create') }}" class="btnAdd btn">Nova Área de Trabalho +</a>
                    <div class="table-responsive">
                        <table class="table" style="font-family: 'Roboto', sans-serif;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>Gerente</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($areas_de_servico as $area_de_servico)
                                    <tr>
                                        <td>{{ $area_de_servico->id }}</td>
                                        <td>{{ $area_de_servico->nome }}</td>
                                        <td>{{ $area_de_servico->gerente->user->name ?? '' }}</td>
                                        
                                        <td class="action-icons">
                                            <a class="btn bi bi-pencil" href="{{ route('area-de-servico.edit', ['area_de_servico' => $area_de_servico]) }}"></a>
                                        
                                            <a class="btn bi bi-eye" href="{{ route('area-de-servico.show', ['area_de_servico' => $area_de_servico['id']]) }}"></a>
                                        
                                            <form method="post" action="{{ route('area-de-servico.destroy', ['area_de_servico' => $area_de_servico]) }}" style="display:inline-block;" onsubmit="return confirm('Deseja excluir esta area de serviço?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn delete-button bi bi-trash"></button>
                                            </form>
                                
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $areas_de_servico->links() }}
                    </div>
                </div>
        
        </main>
    </div>
    <x-item-layout/>
</body>
