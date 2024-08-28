<!doctype html>
<html lang="pt">

<head>
    <x-header-layout />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    @vite('resources/js/kanban.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    @php
        $area_funcionarios = $area_de_servico->funcionarios;
    @endphp
</head>

<body>

    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <a class="btn btn-secondary" href="{{ route('area-de-servico.index') }}">Voltar</a>
                {{-- <a class="btn btn-success" href="{{ route('tarefa.create', ['area_de_servico' => $area_de_servico]) }}">Adicionar
                    Tarefa</a> --}}
                <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tarefa-form">Adicionar Tarefa</a>

                <x-message />

                <table>
                    <tr>
                        <td>Nome:</td>
                        <td>{{ $area_de_servico->nome }}</td>
                    </tr>
                    <tr>
                        <td>Gerente:</td>
                        <td>{{ $area_de_servico->gerente->user->name }}</td>
                    </tr>
                    <tr>
                        <td rowspan="{{ count($area_funcionarios) }}">Funcionarios:</td>
                        @foreach ($area_funcionarios as $funcionario)
                            <td>{{ $funcionario->user->name }}</td>
                        @endforeach
                    </tr>
                </table>



                <div class="board">
                    <form method="POST" id="ajax-form"
                        action="{{ route('area-de-servico.modifica', ['area_de_servico' => $area_de_servico]) }}"
                        id="tarefas">
                        @csrf
                        {{-- <button class="btn btn-info" type="submit">Adicionar</button> --}}

                        <div class="row">
                            <div class="col-sm">
                                <div class="card cartao" id="to-do">
                                    <h3>TO-DO</h3>
                                    @foreach ($tarefas as $tarefa)
                                        @if ($tarefa->status == App\Models\Tarefa\StatusTarefa::A_FAZER)
                                            @include('area-de-servico.cartao', ['tarefa' => $tarefa])
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="card cartao" id="doing">
                                    <h3>DOING</h3>
                                    @foreach ($tarefas as $tarefa)
                                        @if ($tarefa->status == App\Models\Tarefa\StatusTarefa::FAZENDO)
                                            @include('area-de-servico.cartao', ['tarefa' => $tarefa])
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="card cartao" id="finished">
                                    <h3>FINISHED</h3>

                                    @foreach ($tarefas as $tarefa)
                                        @if ($tarefa->status == App\Models\Tarefa\StatusTarefa::CONCLUIDA)
                                            @include('area-de-servico.cartao', ['tarefa' => $tarefa])
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="tarefas_a_fazer" value="" name="tarefas_a_fazer" />
                        <input type="hidden" id="tarefas_fazendo" value="" name="tarefas_fazendo" />
                        <input type="hidden" id="tarefas_concluida" value="" name="tarefas_concluida" />

                    </form>

                </div>


                <div class="modal fade" id="tarefa-form" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="card">
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
