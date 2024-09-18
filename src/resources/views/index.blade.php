@if (auth()->user()->usuario->tipo_usuario == App\Models\Usuario\TipoUsuario::ADMINISTRADOR)
    @include('stats')
@endif

@if (auth()->user()->usuario->tipo_usuario == App\Models\Usuario\TipoUsuario::GERENTE)
    @include('dashboard')
@endif

{{-- @if (auth()->user()->usuario->tipo_usuario == App\Models\Usuario\TipoUsuario::FUNCIONARIO)
    {{ redirect()->route('tarefa.index') }}
@endif

@if (auth()->user()->usuario->tipo_usuario == App\Models\Usuario\TipoUsuario::CLIENTE)
    {{ redirect()->route('solicitacoes.index') }}
@endif --}}
