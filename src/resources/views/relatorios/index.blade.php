<!DOCTYPE html>
<html lang="pt">

<head>
    <x-header-layout />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tarefa.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .report-card {
            position: relative;
            border: none;
            border-radius: .5rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            color: white;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .report-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: inherit;
            filter: blur(8px); /* Desfoque aplicado à imagem de fundo */
            z-index: -1;
        }

        .report-card:hover {
            transform: scale(1.05);
            //box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
        }

        .report-card .card-body {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            background: rgba(0, 0, 0, 0.5); /* Background color with transparency for readability */
            padding: 20px;
            border-radius: .5rem;
        }

        .report-card .card-body h4 {
        }

        .card-link {
            color: inherit;
            text-decoration: none;
            color: white;
        }

        .card-link:hover {
            color: #fff;
            text-decoration: none;
        }


         /* Ajusta o layout para telas menores */
         @media (max-width: 1080px) {
            .report-card {
            flex-direction: column; /* Exibe os cards em uma única coluna */
            align-items: flex-start;
            }
            .report-card {
                flex: 1 1 calc(100% - 40px); /* 2 colunas para telas menores */
                max-width: 96%;
            }
        }
    </style>
</head>

<body>

    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <h2 style="color: #717171;">Relatórios</h2>
                <div class="container mt-4">
                    <div class="row">
                        <!-- Card 1 -->
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('relatorios.clientes') }}" class="card report-card card-link" style="background: url('{{ asset('images/reports.jpg') }}') no-repeat center center; background-size: cover;">
                                <div class="card-body">
                                    <h4 class="card-title">Solicitações dos clientes</h4>
                                </div>
                            </a>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('relatorios.tarefasArea') }}" class="card report-card card-link" style="background: url('{{ asset('images/areadetrabalho.jpg') }}') no-repeat center center; background-size: cover;">
                                <div class="card-body">
                                    <h4 class="card-title">Tarefas por área de serviço</h4>
                                </div>
                            </a>
                        </div>

                        <!-- Card 3 -->
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('relatorios.funcionarios') }}" class="card report-card card-link" style="background: url('{{ asset('images/funcionario.jpg') }}') no-repeat center center; background-size: cover;">
                                <div class="card-body">
                                    <h4 class="card-title">Tarefas por funcionário</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <x-item-layout />
</body>

</html>
