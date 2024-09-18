<!doctype html>
<html lang="pt">

<head>
    <x-header-layout />
    <link href="{{ asset('css/kanban.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    @vite('resources/js/kanban.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    @php
        $area_funcionarios = $area_de_servico->funcionarios;
    @endphp

    <style>
        .modal-conteudo {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 0.3rem;
            outline: 0;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ccc; /* Linha separadora */
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
        }

        .edit-team-button-container {
            text-align: center;
        }
        .edit-team-button {
            display: inline-block;
            width: 200px;
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 15px;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, transform 0.3s;
        }
        .edit-team-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .edit-team-button:focus {
            outline: none;
        }
        @media (max-width: 768px) {
            .edit-team-button {
            width: 150px;
            
            }
        }
    </style>

</head>

<body>

    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <div class="header">
                    <h2>Área de Serviço</h2>
                    <div class="edit-team-button-container">
                        <a class="edit-team-button"
                            href="{{ route('area-de-servico.equipe', ['area_de_servico' => $area_de_servico]) }}">Editar Equipes</a>
                    </div>
                </div>
                <x-message />


                <div class="board">
                    <form method="POST" id="ajax-form"
                        action="{{ route('area-de-servico.modifica', ['area_de_servico' => $area_de_servico]) }}"
                        id="tarefas">
                        @csrf
                        <div class="row">
                            <div class="col-sm">
                                <div class="cardKanban cartao" id="to-do">
                                    <div class="title" style="background-color: #9C9C9C;">
                                        <h5>Abertas</h5>
                                    </div>
                                    <a href="{{ route('area-de-servico.create') }}" data-bs-toggle="modal"
                                        data-bs-target="#tarefa-form" id="btnAdd" class="btnAddK"
                                        style="justify-content: center; font-size: 21px; color: gray; border: 2px dashed gray; text-decoration: none;">
                                        <div
                                            style="display: flex; justify-content: space-between; width: 100%; padding: 5px 15px;">
                                            <span>Nova Tarefa</span>
                                            <span>+</span>
                                        </div>

                                    </a>
                                    @foreach ($tarefas as $tarefa)
                                        @if ($tarefa->status == App\Models\Tarefa\StatusTarefa::A_FAZER)
                                            @include('area-de-servico.cartao', ['tarefa' => $tarefa])
                                        @endif
                                    @endforeach
                                </div>
                                <br />
                            </div>
                            <div class="col-sm">
                                <div class="cardKanban cartao" id="doing">
                                    <div class="title" style="background-color: #0062FF;">
                                        <h5>Em Processo</h5>
                                    </div>
                                    <a href="{{ route('area-de-servico.create') }}" data-bs-toggle="modal"
                                        data-bs-target="#tarefa-form" id="btnAdd" class="btnAddK"
                                        style="justify-content: center; font-size: 21px; color: gray; border: 2px dashed gray; text-decoration: none;">
                                        <div
                                            style="display: flex; justify-content: space-between; width: 100%; padding: 5px 15px;">
                                            <span>Nova Tarefa</span>
                                            <span>+</span>
                                        </div>

                                    </a>
                                    @foreach ($tarefas as $tarefa)
                                        @if ($tarefa->status == App\Models\Tarefa\StatusTarefa::FAZENDO)
                                            @include('area-de-servico.cartao', ['tarefa' => $tarefa])
                                        @endif
                                    @endforeach
                                </div>
                                <br />
                            </div>
                            <div class="col-sm">
                                <div class="cardKanban cartao" id="finished">
                                    <div class="title" style="background-color: #00E823;">
                                        <h5>Concluídas</h5>
                                    </div>
                                    <a href="{{ route('area-de-servico.create') }}" data-bs-toggle="modal"
                                        data-bs-target="#tarefa-form" id="btnAdd" class="btnAddK"
                                        style="justify-content: center; font-size: 21px; color: gray; border: 2px dashed gray; text-decoration: none;">
                                        <div
                                            style="display: flex; justify-content: space-between; width: 100%; padding: 5px 15px;">
                                            <span>Nova Tarefa</span>
                                            <span>+</span>
                                        </div>

                                    </a>
                                    @foreach ($tarefas as $tarefa)
                                        @if ($tarefa->status == App\Models\Tarefa\StatusTarefa::CONCLUIDA)
                                            @include('area-de-servico.cartao', ['tarefa' => $tarefa])
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                            <br />
                        </div>

                        <input type="hidden" id="tarefas_a_fazer" value="" name="tarefas_a_fazer" />
                        <input type="hidden" id="tarefas_fazendo" value="" name="tarefas_fazendo" />
                        <input type="hidden" id="tarefas_concluida" value="" name="tarefas_concluida" />

                    </form>

                </div>


                <div class="modal fade" id="tarefa-form" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="card1">
                                @include('tarefa.form', ['area_de_servico' => $area_de_servico])
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="funcionarios-form" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            @include('area-de-servico.funcionarios', [
                                'funcionarios' => $area_de_servico->funcionarios,
                            ])
                        </div>
                    </div>
                </div>
                
            </div>
        </main>
    </div>
    <x-item-layout />
</body>

</html>
