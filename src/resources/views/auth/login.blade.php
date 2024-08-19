<!doctype html>
<html lang="pt">
<head>
    <title>Login</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">

    @vite(['resources/js/app.js'])

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('{{ asset('images/img.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        
    </style>
</head>
<body>
    <div class="main">
        <div class="card-main">
            <h2 class="heading-section">Login</h2>

            <!-- Formulário de Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="space">
                <div class="form">
                    <!--<label for="email">Email</label>-->
                    <input id="email" type="email" class="form-c" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                </div>

                <!-- Password -->
                <div class="space">
                <div class="form">
                    <!--<label for="password">Password</label>-->
                    <input id="password" type="password" class="form-c" name="password" required autocomplete="current-password" placeholder="Senha">
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                </div>

                <!-- Submit Button and Forgot Password Link -->
                <div class="space">
                <div class="form">
                    <button type="submit" class="btnS">
                        Entrar
                    </button>
                    @if (Route::has('password.request'))
                        <a class="btn-link" href="{{ route('password.request') }}">
                            Esqueceu a senha?
                        </a>
                    @endif
                </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
