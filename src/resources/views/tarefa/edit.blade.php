<!DOCTYPE html>
<html lang="pt">
<head>
    <x-header-layout/>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
   

</head>
<body>
    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <h2 style="color: #717171;">Editar Tarefa</h2>

                <!-- Mensagem de  Erro-->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tarefa.update', $tarefa->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $tarefa->titulo }}" required>
                        @error('titulo')
                        <div class="error-message">
                            <i>&#9888;</i> <!-- Ícone de alerta -->
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea class="form-control" id="descricao" name="descricao" required>{{ $tarefa->descricao }}</textarea>
                        @error('descricao')
                        <div class="error-message">
                            <i>&#9888;</i> <!-- Ícone de alerta -->
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="prazo">Prazo:</label>
                        <input type="date" class="form-control" id="prazo" name="prazo" value="{{$tarefa->prazo}}" >
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </main>
    </div>    
    <x-item-layout/>
</body>
</html>