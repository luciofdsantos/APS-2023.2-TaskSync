<x-layout>
    <h1>{{ $tarefa->nome }}</h1>
    <p>Gerente Responsável: {{ $tarefa->gerente_responsavel }}</p>
    <p>E-mail de Contato: {{ $tarefa->email_contato }}</p>
    <p>Status: {{ $tarefa->status }}</p>
    <p>Descrição: {{ $tarefa->descricao }}</p>
    <a href="{{ route('tarefa.index') }}" class="btn btn-secondary">Voltar</a>
</x-layout>
