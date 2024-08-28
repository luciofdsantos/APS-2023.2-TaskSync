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
        
                <div class="table-responsive">
                    <form method="post" class="form-control">
                        <div class=".userForm">
                            @csrf
                            <label for="name">Nome</label>
                            <input type="text" name="name" value='{{ old('name') }}' required class="form-control">

                            @error('name')
                                <div class="error-message">
                                    <i>&#9888;</i> <!-- Ícone de alerta -->
                                    {{ $message }}
                                </div>
                            @enderror

                            <label for="email">Email</label>
                            <input type="text" name="email" value='{{ old('email') }}' required class="form-control">
                            @error('email')
                                <div class="error-message">
                                    <i>&#9888;</i> <!-- Ícone de alerta -->
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <label for="telefone">Telefone</label>
                        <input type="text" id="phone" name="telefone" value="{{ old('telefone') }}" required class="form-control">
                        @error('telefone')
                            <div class="error-message">
                                <i>&#9888;</i> <!-- Ícone de alerta -->
                                {{ $message }}
                            </div>
                        @enderror

                        <label for="cpf">CPF</label>
                        <input type="text" name="cpf" id="cpf" value='{{ old('cpf') }} 'required class="form-control">
                        @error('cpf')
                            <div class="error-message">
                                <i>&#9888;</i> <!-- Ícone de alerta -->
                                {{ $message }}
                            </div>
                        @enderror

                        <label for="data_nascimento">Data de Nascimento</label>
                        <input type="date" name="data_nascimento" class="form-control" value='{{ old('data_nascimento') }}' required>
                        @error('data_nascimento')
                            <div class="error-message">
                                <i>&#9888;</i> <!-- Ícone de alerta -->
                                {{ $message }}
                            </div>
                        @enderror

                        <label for="numero">Número</label>
                        <input type="text" name="numero" value="{{ old('numero') }}" required class="form-control">
                        @error('numero')
                            <div class="error-message">
                                <i>&#9888;</i> <!-- Ícone de alerta -->
                                {{ $message }}
                            </div>
                        @enderror

                        <label for="rua">Rua</label>
                        <input type="text" name="rua" value="{{ old('rua') }}" required class="form-control">
                        @error('rua')
                            <div class="error-message">
                                <i>&#9888;</i> <!-- Ícone de alerta -->
                                {{ $message }}
                            </div>
                        @enderror

                        <label for="bairro">Bairro</label>
                        <input type="text" name="bairro" value='{{ old('bairro') }}' required class="form-control">
                        @error('bairro')
                            <div class="error-message">
                                <i>&#9888;</i> <!-- Ícone de alerta -->
                                {{ $message }}
                            </div>
                        @enderror

                        <label for="cep">CEP</label>
                        <input type="text" id="cep" name="cep" value='{{ old('cep') }}' required class="form-control">
                        @error('cep')
                            <div class="error-message">
                                <i>&#9888;</i> <!-- Ícone de alerta -->
                                {{ $message }}
                            </div>
                        @enderror

                        <label for="tipo_usuario">Tipo de Usuário</label>
                        <select class="form-control" name="tipo_usuario" value="0" required>
                            @foreach ($tipos as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('tipo_usuario')
                            <div class="error-message">
                                <i>&#9888;</i> <!-- Ícone de alerta -->
                                {{ $message }}
                            </div>
                        @enderror


                        <label for="password">Senha</label>
                        <input type="password" name="password" class="form-control" required>
                        @error('password')
                            <div class="error-message">
                                <i>&#9888;</i> <!-- Ícone de alerta -->
                                {{ $message }}
                            </div>
                        @enderror

                        <label for="password_confirmation">Confirmar Senha</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                        @error('password')
                            <div class="error-message">
                                <i>&#9888;</i> <!-- Ícone de alerta -->
                                {{ $message }}
                            </div>
                        @enderror

                        <button type="submit" class="btn btn-success">Salvar</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <x-item-layout/>
</body>
</html>