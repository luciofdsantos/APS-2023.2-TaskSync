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
                <form action="{{ route('tarefa.storeNote', $tarefa->id) }}" method="POST">
                    @csrf
                    <label for="description">Descrição:</label>
                    <textarea name="description" id="description" required></textarea>

                    <button type="submit">Salvar Nota</button>
                </form>
                <a href="{{ route('tarefa.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </main>
    </div>
    <x-item-layout/>
</body>
</html>
