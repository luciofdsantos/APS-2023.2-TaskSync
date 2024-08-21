<x-layout>
    <h1>{{ $tarefa->titulo }}</h1>
    <p>Descrição: {{ $tarefa->descricao }}</p>
    <p>Prazo: {{ $tarefa->deadline }}</p>
    <a href="{{ route('tarefa.index') }}" class="btn btn-secondary">Voltar</a>
</x-layout>
