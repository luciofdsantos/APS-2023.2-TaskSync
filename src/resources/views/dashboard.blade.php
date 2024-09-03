<!doctype html>
<html lang="pt">
<head>
    <x-header-layout/>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <div class="card-columns">
                    <?php
                    $cores = ['#9C68C5', '#8F56AD', '#BE9ECF', '#CEE1DF', '#689D97', '#03665A'];
                    shuffle($cores); 
                    ?>
                    @foreach ($areas_de_servico as $index => $area_de_servico)
                    <?php $corAleatoria = $cores[$index % count($cores)]; // Distribui as cores sequencialmente ?>
                    <a href="{{ route('area-de-servico.show', ['area_de_servico' => $area_de_servico['id']]) }}" class="card-link" style="text-decoration: none;">
                    <div class="card btn" style="background-color: {{$corAleatoria}};">
                        <div class="card-body">
                            <h8
                            <h5 class="card-title" style="font-size: 21px; color: white;">{{$area_de_servico->nome}}</h5>

                            <!-- Precisa Adicionar Funcionários no card - Talvez somente a sigla deles ou 
                                melhor seria se tivesse a foto do perfil-->
                            
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="card-columns" style="display: inherit; text-align: center;">
                    <a href="{{ route('area-de-servico.create') }}" id="btnAdd"class="card btnAdd" style="justify-content: center; font-size: 21px; color: gray; border: 2px dashed gray; text-decoration: none;">Nova Área de Serviço <br/> +</a>
                </div>
            </div>
        
        </main>
        
    </div>
    <x-item-layout />
</body>
</html>
