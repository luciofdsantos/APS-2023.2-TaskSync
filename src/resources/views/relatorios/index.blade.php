<!DOCTYPE html>
<html lang="pt">

<head>
    <x-header-layout />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tarefa.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>

<body>

    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <x-message />
                <a href="{{ route('relatorios.clientes') }}">Solicitações dos clientes</a><br>
                <a href="{{ route('relatorios.tarefasArea') }}">Tarefas por área de serviço</a><br>
                <a href="{{ route('relatorios.funcionarios') }}">Tarefas por funcionário</a><br>
            </div>
        </main>
    </div>
    <x-item-layout />
</body>
