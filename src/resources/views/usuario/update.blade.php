<!doctype html>
<html lang="pt">
<head>
    <x-header-layout/>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body>

    <div class="content-container">
        
        <main class="main-cntt">
            <div class="content-box">

                <h2 style="color: #717171;">Editar Usuário</h2>
                <form method="post" class="">
                    @csrf
                    @method('PUT')

                    <div class="form-row">
                        <div>
                            <label for="name">Nome</label>
                            <input type="text" name="name" value={{ $usuario->user->name }} class="form-control">

                            @error('name')
                                <div class="error-message">
                                    <i>&#9888;</i> <!-- Ícone de alerta -->
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="text" name="email" value={{ $usuario->user->email }} class="form-control">
                            @error('email')
                                <div class="error-message">
                                    <i>&#9888;</i> <!-- Ícone de alerta -->
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div>
                            <label for="telefone">Telefone</label>
                            <input type="text" id="phone" name="telefone" value="{{ $usuario->telefone }}" class="form-control">
                            @error('telefone')
                                <div class="error-message">
                                    <i>&#9888;</i> <!-- Ícone de alerta -->
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf" id="cpf" value={{ $usuario->cpf }} class="form-control">
                            @error('cpf')
                                <div class="error-message">
                                    <i>&#9888;</i> <!-- Ícone de alerta -->
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="data_nascimento">Data de Nascimento</label>
                            <input type="date" class="form-control" name="data_nascimento" value={{ $usuario->data_nascimento }}>
                            @error('data_nascimento')
                                <div class="error-message">
                                    <i>&#9888;</i> <!-- Ícone de alerta -->
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div>
                            <label for="numero">Número</label>
                            <input type="text" name="numero" value={{ $usuario->numero }} class="form-control">
                            @error('numero')
                                <div class="error-message">
                                    <i>&#9888;</i> <!-- Ícone de alerta -->
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="rua">Rua</label>
                            <input type="text" name="rua" value={{ $usuario->rua }} class="form-control">
                            @error('rua')
                                <div class="error-message">
                                    <i>&#9888;</i> <!-- Ícone de alerta -->
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div>
                            <label for="bairro">Bairro</label>
                            <input type="text" name="bairro" value={{ $usuario->bairro }} class="form-control">
                            @error('bairro')
                                <div class="error-message">
                                    <i>&#9888;</i> <!-- Ícone de alerta -->
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="cep">CEP</label>
                            <input type="text" id="cep" name="cep" value={{ $usuario->cep }} class="form-control">
                            @error('cep')
                                <div class="error-message">
                                    <i>&#9888;</i> <!-- Ícone de alerta -->
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="tipo_usuario">Tipo de Usuário</label>
                            <select class="form-control" name="tipo_usuario" style="border-radius: 15px;">
                            @foreach ($tipos as $key => $item)
                                <option value="{{ $key }}" @if ($key == $usuario->tipo_usuario) selected="selected" @endif>
                                    {{ $item }}
                                </option>
                            @endforeach
                            </select>
                            @error('tipo_usuario')
                            <div class="error-message">
                                <i>&#9888;</i> <!-- Ícone de alerta -->
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div>
                            <label for="password">Senha</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                                <div class="error-message">
                                    <i>&#9888;</i> <!-- Ícone de alerta -->
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation">Confirmar Senha</label>
                            <input type="password" name="password_confirmation" class="form-control">
                            @error('password')
                                <div class="error-message">
                                    <i>&#9888;</i> <!-- Ícone de alerta -->
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </form> 
            </div>
        </main>
    </div>
    <x-item-layout/>

</body>
</html>
