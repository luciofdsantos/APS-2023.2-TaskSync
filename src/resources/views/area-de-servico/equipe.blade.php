<!doctype html>
<html lang="pt">

<head>
    <x-header-layout />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body>
    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <x-message />
                <a class="btn btn-secondary"
                    href="{{ route('area-de-servico.show', ['area_de_servico' => $area_de_servico]) }}">Voltar</a>
                <div class="table-responsive">
                    <table class="table" style="font-family: 'Roboto', sans-serif;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Membros</th>
                                <th></th>
                            <tr>
                        </thead>
                        <tbody>
                            @foreach ($equipes as $equipe)
                                <tr>
                                    <td>{{ $equipe->id }}</td>
                                    <td>{{ $equipe->nome }}</td>
                                    <td>{{ $equipe->descricao }}</td>
                                    <td>
                                        @foreach ($equipe->funcionarios as $funcionario)
                                            <p>{{ $funcionario->user->name }}</p>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if (!in_array($equipe->id, $equipes_area))
                                            <a class="btn btn-success bi bi-plus-circle" title="Adicionar Equipe"
                                                href="{{ route('area-de-servico.add-equipe', [
                                                    'area_de_servico' => $area_de_servico,
                                                    'equipe' => $equipe,
                                                ]) }}"></a>
                                        @else
                                            <a class="btn btn-danger bi bi-trash" title="Remover Equipe"
                                                href="{{ route('area-de-servico.del-equipe', [
                                                    'area_de_servico' => $area_de_servico,
                                                    'equipe' => $equipe,
                                                ]) }}"></a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <x-item-layout />
</body>
