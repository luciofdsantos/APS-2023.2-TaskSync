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

                <a class="btn btn-secondary" href="{{ route('/usuario') }}">Voltar</a>
                <form method="post" class="form-control">
                    @csrf
                    @method('PUT')
                    <label for="name">Nome</label>
                    <input type="text" name="name" value={{ $usuario->user->name }} class="form-control">

                    @error('name')
                        <div class="error-message">
                            <i>&#9888;</i> <!-- Ícone de alerta -->
                            {{ $message }}
                        </div>
                    @enderror

                    <label for="email">Email</label>
                    <input type="text" name="email" value={{ $usuario->user->email }} class="form-control">
                    @error('email')
                        <div class="error-message">
                            <i>&#9888;</i> <!-- Ícone de alerta -->
                            {{ $message }}
                        </div>
                    @enderror
                    <br>

                    <label for="telefone">Telefone</label>
                    <input type="text" id="phone" name="telefone" value="{{ $usuario->telefone }}" class="form-control">
                    @error('telefone')
                        <div class="error-message">
                            <i>&#9888;</i> <!-- Ícone de alerta -->
                            {{ $message }}
                        </div>
                    @enderror
                    <br>

                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" value={{ $usuario->cpf }} class="form-control">
                    @error('cpf')
                        <div class="error-message">
                            <i>&#9888;</i> <!-- Ícone de alerta -->
                            {{ $message }}
                        </div>
                    @enderror
                    <br>

                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="date" class="form-control" name="data_nascimento" value={{ $usuario->data_nascimento }}>
                    @error('data_nascimento')
                        <div class="error-message">
                            <i>&#9888;</i> <!-- Ícone de alerta -->
                            {{ $message }}
                        </div>
                    @enderror
                    <br>

                    <label for="numero">Número</label>
                    <input type="text" name="numero" value={{ $usuario->numero }} class="form-control">
                    @error('numero')
                        <div class="error-message">
                            <i>&#9888;</i> <!-- Ícone de alerta -->
                            {{ $message }}
                        </div>
                    @enderror
                    <br>

                    <label for="rua">Rua</label>
                    <input type="text" name="rua" value={{ $usuario->rua }} class="form-control">
                    @error('rua')
                        <div class="error-message">
                            <i>&#9888;</i> <!-- Ícone de alerta -->
                            {{ $message }}
                        </div>
                    @enderror
                    <br>

                    <label for="bairro">Bairro</label>
                    <input type="text" name="bairro" value={{ $usuario->bairro }} class="form-control">
                    @error('bairro')
                        <div class="error-message">
                            <i>&#9888;</i> <!-- Ícone de alerta -->
                            {{ $message }}
                        </div>
                    @enderror
                    <br>

                    <label for="cep">CEP</label>
                    <input type="text" id="cep" name="cep" value={{ $usuario->cep }} class="form-control">
                    @error('cep')
                        <div class="error-message">
                            <i>&#9888;</i> <!-- Ícone de alerta -->
                            {{ $message }}
                        </div>
                    @enderror
                    <br>

                    <label for="tipo_usuario">Tipo de Usuário</label>
                    <select class="form-control" name="tipo_usuario">
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

                    <label for="password">Senha</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                        <div class="error-message">
                            <i>&#9888;</i> <!-- Ícone de alerta -->
                            {{ $message }}
                        </div>
                    @enderror

                    <label for="password_confirmation">Confirmar Senha</label>
                    <input type="password" name="password_confirmation" class="form-control">
                    @error('password')
                        <div class="error-message">
                            <i>&#9888;</i> <!-- Ícone de alerta -->
                            {{ $message }}
                        </div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </form> 
            </div>
        </main>
    </div>
    <x-item-layout/>

</body>
</html>
