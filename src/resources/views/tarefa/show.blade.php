<x-layout>
    {{-- <h1>{{ $tarefa->titulo }}</h1>
    <p>Descrição: {{ $tarefa->descricao }}</p>
    <p>Prazo: {{ $tarefa->deadline }}</p> --}}
    @if (app('request')->input('url'))
        <a href="{{ app('request')->input('url') }}" class="btn btn-secondary">Voltar</a>
    @else
        <a href="{{ route('tarefa.index') }}" class="btn btn-secondary">Voltar</a>
    @endif

    <form method="post" action="{{ route('tarefa.destroy', ['tarefa' => $tarefa]) }}"
        onsubmit="return confirm('Deseja excluir esta tarefa?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Deletar</button>
    </form>

    <table>
        <tr>
            <td class="bold">Id:</td>
            <td>{{ $tarefa->id }}</td>
        </tr>
        <tr>
            <td class="bold">Titulo:</td>
            <td>{{ $tarefa->titulo }}</td>
        </tr>
        <tr>
            <td class="bold">Descrição:</td>
            <td>{{ $tarefa->descricao }}</td>
        </tr>
        <tr>
            <td class="bold">Status:</td>
            <td>{{ App\Models\Tarefa\StatusTarefa::get($tarefa->status) }}</td>
        </tr>
    </table>
</x-layout>
