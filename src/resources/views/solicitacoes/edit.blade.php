<!DOCTYPE html>
<html lang="pt">
<head>
    <x-header-layout/>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
   
   @php
    $data = new DateTime();
    $data = $data->format('Y-m-d');
@endphp
</head>

<body>
    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <h1 style="color: #717171;">Editar Solicitação</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('solicitacoes.update', $solicitacao->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-row">
                        <div>
                            <label for="assunto">Assunto*</label>
                            <input type="text" name="assunto" value="{{ $solicitacao->assunto }}" required class="form-control">
                        </div>
                        <div>
                            <label for="categoria">Categoria*</label>
                            <input type="text" name="categoria" value="{{ $solicitacao->categoria }}" required class="form-control">
                        </div>
                        <div>
                            <label for="prazo">Prazo</label>
                            <input class="form-control" type="date" name="prazo" value="{{ $solicitacao->prazo }}" min={{ $data }}>
                        </div>
                    </div>
                        <label for="descricao">Descrição do Serviço Solicitado*</label>
                    <textarea class="form-control" name="descricao" required>{{ $solicitacao->descricao }}</textarea>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
        </main>
    </div>
    <x-item-layout/>
</body>
