@php
    $area_funcionarios = $area_de_servico->funcionarios;
@endphp
<x-layout>
    <a class="btn btn-secondary" href="{{ route('area-de-servico.index') }}">Voltar</a>

    <table>
        <tr>
            <td>Nome:</td>
            <td>{{ $area_de_servico->nome }}</td>
        </tr>
        <tr>
            <td>Gerente:</td>
            <td>{{ $area_de_servico->gerente->user->name }}</td>
        </tr>
        <tr>
            <td rowspan="{{ count($area_funcionarios) }}">Funcionarios:</td>
            @foreach ($area_funcionarios as $funcionario)
                <td>{{ $funcionario->user->name }}</td>
            @endforeach
        </tr>
    </table>
</x-layout>
