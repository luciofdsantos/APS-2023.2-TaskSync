<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

</head>
<body>
    <div class="flex-grow-1" style="padding: 15px;">
        
        <!-- Header fixo no topo -->
        <header class="bg-white text-dark p-4 rounded-3" style="height: 70px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); position: fixed; top: 0; left: 0; right: 0; z-index: 1000; margin: 15px;">
            <div class="container d-flex justify-content-between align-items-center">
                <a href="{{route('dashboard')}}">
                <img src="images/taskSync_logo.png" class="btnLogo" alt="alt text">
                </a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btnSair">
                        <i class="bi bi-box-arrow-right" style="font-size: 1.5rem"></i>
                    </button>
                </form>
            </div>
        </header>
        
        

        <!-- Espaçamento para garantir que o conteúdo não fique coberto pelo header -->
        <div style="height: 45px;"></div>

        <!-- Conteúdo principal -->
        <!--
        <main id="mainContent" class="p-4">
            <div class="bg-white shadow-lg rounded-3 p-4">
                
            </div>
        </main>-->
    </div> 
</body>
</html>
