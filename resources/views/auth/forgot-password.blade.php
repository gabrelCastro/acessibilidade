<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/esqueciAsenha.css')
    <title>Document</title>
</head>
<body>

    <div class="container">
        <div class="tituloES">
            ESQUECEU A SENHA?
        </div>

        <div class="avisoES">
           Insira seu endereço de e-mail abaixo e enviaremos um link para redefinir sua senha.
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label class="labelEmail" for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="inputEmail" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="btnEnviar">
                    {{ __('Enviar Email') }}
                </x-button>
            </div>
        </form>

        <div class="resposta">
        @session('status')
        {{ $value }}
        @endsession
        </div>    

    </div>


</body>
</html>