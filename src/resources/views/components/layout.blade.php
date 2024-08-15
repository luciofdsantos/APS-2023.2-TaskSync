<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('app.css  ') }}">
    @vite('resources/js/app.js')
</head>

<body>
    <header>
        <h1>TaskSync</h1>
        <a href="/usuario" class="btn btn-info">Usuarios</a>
        <a href="/tarefa" class="btn btn-info">Tarefas</a>
    </header>

    <main class="container">
        {{ $slot }}
    </main>

</body>

</html>
