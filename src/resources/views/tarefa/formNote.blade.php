<h1>Criar Nota</h1>
<!-- <form action="{{route('tarefa.storeNote', ['id' => $tarefa->id]) }}" method="POST"> -->
<form id="add-note-form" action="{{ route('tarefa.storeNote', ['id' => $tarefa->id]) }}" method="POST">
    @csrf
    <label for="descricao">Descrição:</label>
    <textarea class="form-control" id="descricao" name="descricao" required></textarea>
    @error('descricao')
        <div class="error-message">
            <i>&#9888;</i> <!-- Ícone de alerta -->
            {{ $message }}
        </div>
    @enderror
    <button type="submit" >Salvar</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#add-note-form').submit(function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    // Atualiza a lista de notas na página
                    $('#notes-list').append(
                        `<li>${response.nota.description}</li>`
                    );
                    // Limpa os campos do formulário
                    $('#add-note-form')[0].reset();
                } else {
                    alert('Erro ao adicionar a nota.');
                }
            },
            error: function() {
                alert('Erro ao enviar a solicitação.');
            }
        });
    });
});
</script>
