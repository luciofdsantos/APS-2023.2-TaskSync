<!DOCTYPE html>
<html lang="pt">

<head>
    <x-header-layout />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                {{-- <h1>{{ $tarefa->titulo }}</h1>
                <p>Descrição: {{ $tarefa->descricao }}</p>
                <p>Prazo: {{ $tarefa->deadline }}</p> --}}
                @if (app('request')->input('url'))
                    <a href="{{ app('request')->input('url') }}" class="btn btn-secondary">Voltar</a>
                @else
                    <a href="{{ route('tarefa.index') }}" class="btn btn-secondary">Voltar</a>
                @endif
                @can('editar', 'App\Models\Tarefa\Tarefa')
                    <form method="post" action="{{ route('tarefa.destroy', ['tarefa' => $tarefa]) }}"
                        onsubmit="return confirm('Deseja excluir esta tarefa?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Deletar</button>
                    </form>
                @endcan

                <table class="table">

                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 10%;">Título</th>
                            <th style="width: 55%;">Descrição</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 10%;">Notas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>{{ $tarefa->id }}</td>
                        <td>{{ $tarefa->titulo }}</td>
                        <td>{{ $tarefa->descricao }}</td>
                        <td class="action-icons">{{ App\Models\Tarefa\StatusTarefa::get($tarefa->status) }}

                            @can('status', $tarefa)
                                <button type="button" class="btn bi bi-pencil" data-bs-toggle="modal"
                                    data-bs-target="#changeStatusModal"></button>
                            @endcan
                        </td>
                        <td class="action-icons">
                            <!-- Botão para abrir o modal -->
                            <button type="button" class="btn bi bi-pencil" data-bs-toggle="modal"
                                data-bs-target="#addNoteModal"></button>

                            <a class="btn bi bi-eye" onclick="toggleNotas({{ $tarefa->id }})"></a>
                        </td>

                        <tr id="notas-{{ $tarefa->id }}" style="">
                            <td colspan="5">
                                <ul>
                                    @foreach ($tarefa->notas as $nota)
                                        <li>{{ $nota->description }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <x-item-layout />
</body>

<script>
    function toggleNotas(tarefaId) {
        var notasRow = document.getElementById('notas-' + tarefaId);
        if (notasRow.style.display === 'none') {
            notasRow.style.display = '';
        } else {
            notasRow.style.display = 'none';
        }
    }
</script>

<!-- Modal Nota-->
<div class="modal fade" id="addNoteModal" tabindex="-1" aria-labelledby="addNoteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNoteModalLabel">Adicionar Nota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addNoteForm" method="POST" action="{{ route('tarefa.storeNote', ['id' => $tarefa->id]) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Nota</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Status-->
<div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="changeStatusModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeStatusModalLabel">Mudar Status da Tarefa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="changeStatusForm" method="POST" action="{{ route('tarefa.updateStatus', $tarefa->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="status" class="form-label">Novo Status</label>
                        <select class="form-control" id="status" name="status" required>
                            @foreach (App\Models\Tarefa\StatusTarefa::getAll() as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- <script>
    document.getElementById('addNoteForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o envio tradicional do formulário

        let formData = new FormData(this);

        fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Fechar o modal
                    let modal = bootstrap.Modal.getInstance(document.getElementById('addNoteModal'));
                    modal.hide();

                    // Atualizar a lista de notas sem recarregar a página
                    let notaList = document.getElementById('notas-' + data.nota.tarefa_id);
                    notaList.innerHTML += '<li>' + data.nota.description + '</li>';
                }
            })
            .catch(error => console.error('Erro:', error));
    });
</script> -->
