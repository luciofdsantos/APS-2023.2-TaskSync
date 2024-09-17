<!doctype html>
<html lang="pt">

<head>
    <x-header-layout />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <h1>Status de tarefas por Área de Serviço</h1>
                <div style="height:400px;">
                    <canvas id="myChart"></canvas>
                </div>
                <hr>
                <h1>Tarefas concluídas por funcionário</h1>
                <div style="height:400px;">
                    <canvas id="myChart1"></canvas>
                </div>
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

    const datasets = Object.entries(status_list).map(([key, value]) => {
        return {
            label: `${value}`,
            data: labels.map(area => {
                const a = tarefas.find(t => t.nome === area && t.status == key);

                return a ? a.quantidade : 0;
            }),
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
