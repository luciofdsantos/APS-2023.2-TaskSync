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
                
                <h2>Equipe</h2>

                <table class="table">

                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 10%;">Nome</th>
                            <th style="width: 55%;">Descricao</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>{{ $equipe->id }}</td>
                        <td>{{ $equipe->titulo }}</td>
                        <td>{{ $equipe->descricao }}</td>
                    </tbody>
                </table>
    <x-item-layout/>
</body>
