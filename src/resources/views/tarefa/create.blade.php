<x-layout>
        <h1>Criar Tarefa</h1>
        <form action="{{ route('tarefa.store') }}" method="POST">
            @csrf
            <label for="nome">Nome da Tarefa:</label>
            <input type="text" name="nome" id="nome" required>
            
            <label for="gerente_responsavel">Gerente Responsável:</label>
            <input type="text" name="gerente_responsavel" id="gerente_responsavel" required>
            
            <label for="email_contato">E-mail de Contato:</label>
            <input type="email" name="email_contato" id="email_contato" required>
            
            <label for="status">Status:</label>
            <input type="text" name="status" id="status" required>
            
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" required></textarea>
            
            <button type="submit" class="btn btn-success">Salvar</button>
        </form>

 </x-layout>
