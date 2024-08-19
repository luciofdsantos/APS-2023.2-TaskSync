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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>



<body class="font-sans antialiased">
    <div class="d-flex min-vh-100">

        <!-- Side Bar -->
        <aside id="sidebar" class="bg-white text-dark p-3 position-fixed" style="width: 300px; 
            margin: 15px; border-radius: 15px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Increased shadow for better effect */
            top: 80px; bottom: 15px; right: auto;">

            <!-- Logo -->
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="fs-3 fw-bold">Task Sync</span>
                <button type="button" class="btn btn-outline-secondary d-md-none" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
            </div>
            <!-- Nav Links -->
            <h5>Início</h5>
            <nav class="nav flex-column">
                <a class="btn btn-outline-primary d-flex align-items-center mb-2" href="/dashboard">
                    <i class="bi bi-house-door me-2"></i> Área de Trabalho
                </a>
                <h5>Menu</h5>
                <a class="btn btn-outline-primary d-flex align-items-center mb-2" href="/calendar">
                    <i class="bi bi-calendar me-2"></i> Calendário
                </a>
                <a class="btn btn-outline-primary d-flex align-items-center mb-2" href="/usuario">
                    <i class="bi bi-person me-2"></i> Usuários
                </a>
                <a class="btn btn-outline-primary d-flex align-items-center mb-2" href="/reports">
                    <i class="bi bi-file-earmark-text me-2"></i> Relatórios
                </a>
                <a class="btn btn-outline-primary d-flex align-items-center mb-2" href="/tarefa">
                    <i class="bi bi-list-task me-2"></i> Tarefas
                </a>
                <a>
                     <!-- Logout Button -->
                     <!--Provisório -->
                <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-box-arrow-right"></i> {{ __('Logout') }}
                </button>
            </form>
                </a>
            </nav>
        </aside>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const menuToggle = document.getElementById('menuToggle');
            const mainContent = document.getElementById('mainContent');

            sidebarToggle.addEventListener('click', function () {
                sidebar.classList.toggle('d-none');
                adjustMainContentMargin();
            });

            menuToggle.addEventListener('click', function () {
                sidebar.classList.toggle('d-none');
                adjustMainContentMargin();
            });

            function adjustMainContentMargin() {
                if (sidebar.classList.contains('d-none')) {
                    mainContent.style.marginLeft = '0';
                } else {
                    mainContent.style.marginLeft = '310px'; // Adjust for sidebar width + margin
                }
            }
        });
    </script>
</body>

</html>
