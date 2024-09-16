<!doctype html>
<html lang="pt">

<head>
    <x-header-layout />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            /* Garante que o menu fique alinhado à direita */
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            transition: opacity 0.3s ease;
            /* Suaviza a exibição do menu */
            opacity: 0;
            border-radius: 15px;
            /* Arredonda as bordas do menu */
        }

        .dropdown-content a,
        .dropdown-content button {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s, color 0.3s;
            /* Suaviza a mudança de cor */
            border-radius: 15px;
            /* Arredonda as bordas do menu */
        }

        .dropdown-content a:hover,
        .dropdown-content button:hover {
            background-color: #007bff;
            /* Azul padrão do Bootstrap */
            color: white;
            /* Cor do texto ao passar o cursor */
        }

        .dropdown-content .btn-delete:hover {
            background-color: #dc3545 !important;
            /* Vermelho para o botão excluir */
            color: white !important;
            /* Cor do texto ao passar o cursor */
        }

        .dropdown:hover .dropdown-content {
            display: block;
            opacity: 1;
            /* Torna o menu visível */
        }

        .dropdown:hover .btn-options {
            color: #FFFFFF;
            transform: rotate(90deg);
            /* Rotaciona o ícone ao passar o cursor */
            animation: glow 1s ease-in-out infinite;
            /* Adiciona animação de brilho */
        }

        @keyframes glow {
            0% {
                text-shadow: 0 0 5px #007bff, 0 0 10px #007bff, 0 0 15px #007bff;
            }

            50% {
                text-shadow: 0 0 10px #007bff, 0 0 20px #007bff, 0 0 30px #007bff;
            }

            100% {
                text-shadow: 0 0 5px #007bff, 0 0 10px #007bff, 0 0 15px #007bff;
            }
        }

        .btn-options {
            background-color: transparent;
            border: none;
            font-size: 24px;
            color: white;
            cursor: pointer;
            transition: color 0.3s, transform 0.5s;
            /* Adiciona uma transição suave */
        }
    </style>
</head>

<body>
    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <div class="card-columns">
                    <?php
                    $cores = ['#9C68C5', '#8F56AD', '#BE9ECF', '#689D97', '#03665A'];
                    shuffle($cores);
                    ?>
                    @foreach ($areas_de_servico as $index => $area_de_servico)
                        <?php $corAleatoria = $cores[$index % count($cores)]; ?>
                        <div class="card btn" style="background-color: {{ $corAleatoria }}; position: relative;">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 21px; color: white;">
                                    {{ $area_de_servico->nome }}
                                </h5>

                                <!-- Botão de opções com ícone Bootstrap -->
                                <div class="dropdown" style="position: absolute; top: 10px; right: 10px;">
                                    <button class="btn-options">
                                        <i class="bi bi-three-dots"></i> <!-- Ícone Bootstrap -->
                                    </button>

                                    <div class="dropdown-content">
                                        <!-- Botão de Visualizar -->
                                        <a href="{{ route('area-de-servico.show', ['area_de_servico' => $area_de_servico['id']]) }}"
                                            style="display: flex; align-items: center;">
                                            <i class="bi bi-eye" style="margin-right: 8px;"></i> Visualizar
                                        </a>

                                        <!-- Botão de Editar -->
                                        <a href="{{ route('area-de-servico.edit', ['area_de_servico' => $area_de_servico['id']]) }}"
                                            style="display: flex; align-items: center;">
                                            <i class="bi bi-pencil" style="margin-right: 8px;"></i> Editar
                                        </a>

                                        <!-- Botão de Excluir com Formulário -->
                                        <form
                                            action="{{ route('area-de-servico.destroy', ['area_de_servico' => $area_de_servico['id']]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Tem certeza que deseja excluir esta área de serviço?');"
                                            style="display: flex; align-items: center;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete"
                                                style="border: none; background-color: transparent; color: black; padding: 12px 16px; cursor: pointer; display: flex; align-items: center; width: 100%;">
                                                <i class="bi bi-trash" style="margin-right: 8px;"></i> Excluir
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Card de adicionar nova área -->
                    <a href="{{ route('area-de-servico.create') }}" id="btnAdd" class="card btnAdd2"
                        style="justify-content: center; font-size: 21px; color: gray; border: 2px dashed gray; text-decoration: none;">
                        Nova Área de Serviço <br /> +
                    </a>
                </div>
            </div>

        </main>

    </div>
    <x-item-layout />
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Seleciona todos os cards que têm o atributo data-url
        var cards = document.querySelectorAll('.card.btn[data-url]');

        // Adiciona o evento de clique a cada card
        cards.forEach(function(card) {
            card.addEventListener('click', function() {
                var url = this.getAttribute('data-url');
                window.location.href = url; // Redireciona para a URL do card
            });
        });
    });
</script>


</html>
