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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link href="{{ asset('css/sideBar.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div id="app" class="d-flex min-vh-100">

        <!-- Side Bar -->
        <aside id="sidebar" class="bg-white text-dark p-3 position-fixed d-none" style="width: 300px; 
            margin: 15px; border-radius: 15px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
            top: 80px; bottom: 15px; right: auto;">

            <!-- Logo -->
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5>Início</h5>
                <!--Toggle Menu -->
                <button type="button" class="hideButton" id="sidebarToggle">
                    <i id="toggleIcon" class="bi bi-chevron-left"></i>
                </button>
            </div>
            <!-- Nav Links -->
            <nav class="nav flex-column">
                <a class="btn d-flex align-items-center mb-2 {{ request()->is('dashboard') ? 'btn-primary' : 'btn-outline-primary' }}" href="/dashboard">
                    <i class="bi bi-house-door me-2"></i> Área de Trabalho
                </a>
                <h5>Menu</h5>
                
                <a class="btn d-flex align-items-center mb-2 {{ request()->is('calendar') ? 'btn-primary' : 'btn-outline-primary' }}" href="/calendar">
                    <i class="bi bi-calendar me-2"></i> Calendário
                </a>
                <a class="btn d-flex align-items-center mb-2 {{ request()->is('usuario') ? 'btn-primary' : 'btn-outline-primary' }}" href="/usuario">
                    <i class="bi bi-person me-2"></i> Usuários
                </a>
                <a class="btn d-flex align-items-center mb-2 {{ request()->is('reports') ? 'btn-primary' : 'btn-outline-primary' }}" href="/reports">
                    <i class="bi bi-file-earmark-text me-2"></i> Relatórios
                </a>
                <a class="btn d-flex align-items-center mb-2 {{ request()->is('tarefa') ? 'btn-primary' : 'btn-outline-primary' }}" href="/tarefa">
                    <i class="bi bi-list-task me-2"></i> Tarefas
                </a>
                
                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-box-arrow-right"></i> {{ __('Logout') }}
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Mini Sidebar -->
        <aside id="miniSidebar" class="d-flex flex-column position-fixed bg-light p-2 text-center" 
            style="width: 60px; top: 90px; bottom: 15px; left: 15px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            
            <div class="d-flex flex-column align-items-center mt-4">
                <!-- Placeholder for the collapsed state -->
                <button id="expandButton" class="btn btn-outline-secondary">
                    <i class="bi bi-chevron-right"></i>
                </button>
                <a href="/dashboard" class="text-dark mb-4 {{ request()->is('dashboard') ? 'btn-primary' : 'btn-outline-primary' }}">
                    <i class="bi bi-house-door" style="font-size: 1.5rem"></i>
                </a>
                <a href="/calendar" class="text-dark mb-4 {{ request()->is('calendar') ? 'btn-primary' : 'btn-outline-primary' }}">
                    <i class="bi bi-calendar" style="font-size: 1.5rem"></i>
                </a>
                <a href="/usuario" class="text-dark mb-4 {{ request()->is('usuario') ? 'btn-primary' : 'btn-outline-primary' }}">
                    <i class="bi bi-person" style="font-size: 1.5rem"></i>
                </a>
                <a href="/reports" class="text-dark mb-4 {{ request()->is('reports') ? 'btn-primary' : 'btn-outline-primary' }}">
                    <i class="bi bi-file-earmark-text" style="font-size: 1.5rem"></i>
                </a>
                <a href="/tarefa" class="text-dark mb-4 {{ request()->is('tarefa') ? 'btn-primary' : 'btn-outline-primary' }}">
                    <i class="bi bi-list-task" style="font-size: 1.5rem"></i>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn text-dark mb-4">
                        <i class="bi bi-box-arrow-right" style="font-size: 1.5rem"></i>
                    </button>
                </form>
            </div>
        </aside>

    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
       document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const miniSidebar = document.getElementById('miniSidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const toggleIcon = document.getElementById('toggleIcon');
            const expandButton = document.getElementById('expandButton');

            // Inicialmente, miniSidebar visível e sidebar oculta
            miniSidebar.classList.remove('d-none');
            sidebar.classList.add('d-none');

            sidebarToggle.addEventListener('click', function () {
                if (sidebar.classList.contains('d-none')) {
                    // Mostrar sidebar e ocultar miniSidebar
                    sidebar.classList.remove('d-none');
                    miniSidebar.classList.add('d-none');
                    toggleIcon.classList.remove('bi-chevron-right');
                    toggleIcon.classList.add('bi-chevron-left');
                    expandButton.classList.add('d-none');
                } else {
                    // Ocultar sidebar e mostrar miniSidebar
                    sidebar.classList.add('d-none');
                    miniSidebar.classList.remove('d-none');
                    expandButton.classList.remove('d-none');
                }
            });

            expandButton.addEventListener('click', function () {
                sidebar.classList.remove('d-none');
                miniSidebar.classList.add('d-none');
                expandButton.classList.add('d-none');
                toggleIcon.classList.remove('bi-chevron-right');
                toggleIcon.classList.add('bi-chevron-left');
            });
        });
    </script>
</body>
</html>
