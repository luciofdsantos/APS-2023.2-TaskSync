<div class="task cardInter {{ $tarefa->status == App\Models\Tarefa\StatusTarefa::A_FAZER ? 'tarefa-aberta' : ($tarefa->status == App\Models\Tarefa\StatusTarefa::FAZENDO ? 'tarefa-em-processo' : 'tarefa-concluida') }}"
    draggable="true" value="{{ $tarefa->id }}">
    <div class="task-header" style="display: flex; justify-content: space-between; width: 100%; padding: 5px 15px;">
        <h6>Área de Trabalho ></h6>
        <div class="dropdown" style="position: relative;">
            <button type="button" class="btn-options" style="color: black;">
                <i class="bi bi-three-dots"></i> <!-- Ícone Bootstrap -->
            </button>
            <div class="dropdown-content">
                <!-- Botão de Visualizar -->
                <a href="{{ route('tarefa.show', ['tarefa' => $tarefa, 'url' => url()->current()]) }}"
                    style="display: flex; align-items: center;">
                    <i class="bi bi-eye" style="margin-right: 8px;"></i> Visualizar
                </a>

                <!-- Botão de Editar -->
                {{--<a href="{{ route('area-de-servico.equipe', ['area_de_servico' => $area_de_servico]) }}"
                    style="display: flex; align-items: center;">
                    <i class="bi bi-person-lines-fill" style="margin-right: 8px;"></i> Editar Equipe
                </a>--}}

                <button type="button" data-bs-toggle="modal" data-bs-target="#funcionarios-form"
                    class="dropdown-button"
                    data-url="{{ route('area-de-servico.adiciona-funcionario', ['area_de_servico' => $area_de_servico, 'tarefa' => $tarefa]) }}"
                    data-tarefa="{{ $tarefa->id }}" style="display: flex; align-items: center;">
                    <i class="bi bi-pencil" style="margin-right: 8px;"></i> Editar Funcionários
                </button>
            </div>
        </div>
    </div>

    <div class="task-header">
        <h4>{{ $tarefa->titulo }}</h4>
    </div>
    <div class="task-details">
        @if (!$tarefa->funcionarios->isEmpty())
            <div class="details-header">
                <h5>Funcionários:</h5>
                <ul class="employee-list">
                    @foreach ($tarefa->funcionarios as $funcionario)
                        <li>{{ $funcionario->user->name }}</li>
                    @endforeach
                </ul>
            </div>
        @else
            <h5>Sem funcionários</h5>
        @endif
        <p>Descrição: {{ $tarefa->descricao }}</p>
    </div>
    <br />

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateTaskColors() {
            document.querySelectorAll('.task').forEach(task => {
                const columnId = task.closest('.cardKanban').id; // Obtém o id do cardKanban
                let columnValue;

                switch (columnId) {
                    case 'to-do':
                        columnValue = 'A_FAZER';
                        break;
                    case 'doing':
                        columnValue = 'FAZENDO';
                        break;
                    case 'finished':
                        columnValue = 'CONCLUIDA';
                        break;
                }

                task.setAttribute('data-column', columnValue);
            });
        }

        // Atualiza as cores ao carregar a página
        updateTaskColors();

        // Atualiza as cores quando uma tarefa for movida (ajustar conforme necessário)
        const containers = document.querySelectorAll('.cardKanban');
        containers.forEach(container => {
            container.addEventListener('drop', updateTaskColors);
            container.addEventListener('dragend', updateTaskColors);
        });
    });
</script>
