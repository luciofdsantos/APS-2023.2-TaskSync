<!doctype html>
<html lang="pt">

<head>
    <x-header-layout />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <style>
        .btn-voltar {
            margin: 20px 0; /* Ajusta a margem superior e inferior */
            display: inline-block;
            padding: 10px 20px; /* Ajusta o padding interno do botão */
            font-size: 16px; /* Ajusta o tamanho da fonte do botão */
            text-decoration: none;
            color: #fff; /* Cor do texto */
            background-color: #6c757d; /* Cor de fundo */
            border: 1px solid #6c757d; /* Cor da borda */
            border-radius: 4px; /* Borda arredondada */
        }

        .btn-voltar:hover {
            background-color: #5a6268; /* Cor de fundo quando o botão é hovered */
            border-color: #5a6268; /* Cor da borda quando o botão é hovered */
        }
    </style>
</head>

<body>
    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <x-message />
                <a class="btn btn-voltar"
                    href="{{ route('area-de-servico.show', ['area_de_servico' => $area_de_servico]) }}" style="border: 40px;">Voltar</a>
                <div class="table-responsive">
                    <table class="table" style="font-family: 'Roboto', sans-serif;">
                        <thead>
                            <tr>
                                <th style="width: 5px;">ID</th>
                                <th style="width: 20px;">Nome</th>
                                <th style="width: 20px;">Descrição</th>
                                <th style="width: 30px;">Membros</th>
                                
                            
                                <th style="width: 20px;">Ações</th>
                                
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
