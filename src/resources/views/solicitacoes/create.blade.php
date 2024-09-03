<!DOCTYPE html>
<html lang="pt">
<head>
    <x-header-layout/>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        

    </style>

</head>
<body>
    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                @php
                    $data = new DateTime();
                    $data = $data->format('Y-m-d');
                @endphp

                <h1 >Nova Solicitação</h1>
                <!--
                <a href="{{ route('solicitacoes.index') }}" class="btn btn-secondary">Voltar</a>
                -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('solicitacoes.store') }}" method="POST">
                    @csrf
                    <label for="assunto">Assunto*</label>
                    <input type="text" name="assunto" value="{{ old('assunto') }}" required class="form-control">

                    <label for="descricao">Descrição do Serviço Solicitado*</label>
                    <textarea class="form-control" name="descricao" required>{{ old('descricao') }} </textarea>
                    
                    <div class="form-row">
                        <div>
                            <label for="prazo">Prazo</label>
                            <input class="form-control" type="date" name="prazo" value="{{ old('prazo') }}" min={{ $data }}>
                        </div>
                        <div>
                            <label for="categoria">Categoria*</label>
                            <input class="form-control" type="text" name="categoria" value="{{ old('categoria') }}" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Enviar Solicitação</button>
                </form>
            </div>
        </main>
    </div>
    <x-item-layout/>
</body>
</html>
