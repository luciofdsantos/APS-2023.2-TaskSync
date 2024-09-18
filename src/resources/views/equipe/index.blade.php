<!DOCTYPE html>
<html lang="pt">

<head>
    <x-header-layout />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>

<body>

    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <x-message />
                {{-- <h1>Gerenciar Tarefas</h1> --}}
                <a href="{{ route('equipe.create') }}" class="btnAdd btn">Nova Equipe +</a>
                <div>
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">Id</th>
                                    <th style="width: 25%;">Nome</th>
                                    <th style="width: 55%;">Descrição</th>
                                    <th><th>
                                        <th><th>
                                    <th style="width: 15%;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipes as $equipe)
                                    <tr>
                                        <td>{{ $equipe->id }}</td>
                                        <td>{{ $equipe->nome }}</td>
                                        <td>{{ $equipe->descricao }}</td>
                                        <th><th>
                                        <th><th>
                                        <td class="action-icons">
                                            <a class="btn bi bi-pencil"
                                                href="{{ route('equipe.edit', ['equipe' => $equipe]) }}""></a>

                                            <a class="btn bi bi-eye"
                                                href="{{ route('equipe.show', ['equipe' => $equipe]) }}"></a>
                                            <form method="post"
                                                action="{{ route('equipe.destroy', ['equipe' => $equipe]) }}"
                                                onsubmit="return confirm('Deseja excluir esta equipe?')"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn bi bi-trash"></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $equipes->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>
    <x-item-layout />
</body>
