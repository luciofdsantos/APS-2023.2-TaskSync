@if (auth()->user()->usuario->tipo_usuario == App\Models\Usuario\TipoUsuario::ADMINISTRADOR)
    @include('stats')
@endif

@if (auth()->user()->usuario->tipo_usuario == App\Models\Usuario\TipoUsuario::GERENTE)
    @include('dashboard')
@endif
