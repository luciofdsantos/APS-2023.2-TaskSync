<x-layout>
    <a class="btn btn-secondary" href="{{ route('/usuario') }}">Voltar</a>
    <form method="post" class="form-control">
        @csrf
        @method('PUT')
        <label for="name">Nome</label>
        <input type="text" name="name" value={{ $usuario->users->name }}>

        @error('name')
            <div class="error-message">
                <i>&#9888;</i> <!-- Ícone de alerta -->
                {{ $message }}
            </div>
        @enderror

        <label for="email">Email</label>
        <input type="text" name="email" value={{ $usuario->users->email }}>
        @error('email')
            <div class="error-message">
                <i>&#9888;</i> <!-- Ícone de alerta -->
                {{ $message }}
            </div>
        @enderror
        <br>

        <label for="telefone">Telefone</label>
        <input type="text" id="phone" name="telefone" value="{{ $usuario->telefone }}">
        @error('telefone')
            <div class="error-message">
                <i>&#9888;</i> <!-- Ícone de alerta -->
                {{ $message }}
            </div>
        @enderror
        <br>

        <label for="cpf">CPF</label>
        <input type="text" name="cpf" id="cpf" value={{ $usuario->cpf }}>
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
        <input type="text" name="numero" value={{ $usuario->numero }}>
        @error('numero')
            <div class="error-message">
                <i>&#9888;</i> <!-- Ícone de alerta -->
                {{ $message }}
            </div>
        @enderror
        <br>

        <label for="rua">Rua</label>
        <input type="text" name="rua" value={{ $usuario->rua }}>
        @error('rua')
            <div class="error-message">
                <i>&#9888;</i> <!-- Ícone de alerta -->
                {{ $message }}
            </div>
        @enderror
        <br>

        <label for="bairro">Bairro</label>
        <input type="text" name="bairro" value={{ $usuario->bairro }}>
        @error('bairro')
            <div class="error-message">
                <i>&#9888;</i> <!-- Ícone de alerta -->
                {{ $message }}
            </div>
        @enderror
        <br>

        <label for="cep">CEP</label>
        <input type="text" id="cep" name="cep" value={{ $usuario->cep }}>
        @error('cep')
            <div class="error-message">
                <i>&#9888;</i> <!-- Ícone de alerta -->
                {{ $message }}
            </div>
        @enderror
        <br>

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
</x-layout>
