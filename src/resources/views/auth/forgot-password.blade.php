<!doctype html>
<html lang="pt">

<head>
    <title>Esqueceu a senha?</title>

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
            background-image: url('{{ asset('images/abstract.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>

</head>
<body>
    <div class="main">
        <div class="card-main">
            <h2 class="heading-section">Esqueceu a Senha?</h2>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <!-- Email Address -->
                <div class="space">
                <div class="form">
                    <label for="email" :value="__('Email')" />
                    <input id="email" class="form-c" type="email" name="email" :value="old('email')" required autofocus placeholder="Email"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                </div>        
                <div class="space">
                <div class="form">
                    <button class="btnS">
                        {{ __('Resetar a Senha!') }}
                    </button>
                </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
