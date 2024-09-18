<!doctype html>
<html lang="pt">

<head>
    <x-header-layout />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap; /* Permite que os gráficos se movam para baixo em telas menores */
        }
        .chart-container > div {
            flex: 1;
            min-width: 400px; /* Define a largura mínima para os gráficos */
            box-sizing: border-box; /* Inclui padding e border no tamanho total */
        }
        @media (max-width: 1080px) {
            .chart-container {
                min-width: 290px;
                flex-direction: column;
            }
        }
        @media (max-width: 768px) {
            .chart-container {
                flex-direction: column;
            }
            .chart-container > div {
                margin-bottom: 20px; /* Adiciona espaçamento entre gráficos em tela menor */
                max-width: 90%; /* Garante que o gráfico não ultrapasse o contêiner */
            }
            .chart-container > div canvas {
                height: 200px !important; /* Ajusta a altura do gráfico para telas menores */
            }
        }
    </style>
</head>

<body>
    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <h1>Status de tarefas por Área de Serviço</h1>
                <div class="chart-container">
                    <div style="height:400px;">
                        <canvas id="myChart"></canvas>
                    </div>
                    <div style="height:400px;">
                        <canvas id="myChart1"></canvas>
                    </div>
                </div>
                <hr>
            </div>
        </main>
    </div>
    <x-item-layout />
</body>

<script>
    // GRÁFICO 1
    const tarefas = @json($tarefas);
    const status_list = @json($status);

    const labels = [...new Set(tarefas.map(tarefas => tarefas.nome))];
    const status = tarefas.map(tarefa => tarefa.status);
    const quantidade = tarefas.map(tarefa => tarefa.quantidade);

    const datasets = Object.entries(status_list).map(([key, value], index) => {
        return {
            label: `${value}`,
            data: labels.map(area => {
                const a = tarefas.find(t => t.nome === area && t.status == key);
                return a ? a.quantidade : 0;
            }),
            backgroundColor: `rgba(${index * 60}, ${150 - index * 30}, 150, 0.5)`, // Alterar cores conforme necessário
            borderColor: `rgba(${index * 60}, ${150 - index * 30}, 150, 1)`,
            borderWidth: 1
        };
    });

    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // GRÁFICO 2
    const tarefa_usuarios = @json($tarefas_funcionarios);
    const ctx1 = document.getElementById('myChart1');

    const labels1 = tarefa_usuarios.map(t => t.nome);
    const qtd = tarefa_usuarios.map(t => t.tarefas_concluidas);

    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: labels1,
            datasets: [{
                label: 'Tarefas concluídas',
                data: qtd,
                backgroundColor: 'rgba(54, 162, 235, 0.5)', // Alterar cor conforme necessário
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</html>
