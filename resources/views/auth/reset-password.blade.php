<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESETAR SENHA</title>
    @vite('resources/css/resetarSenha.css')
</head>
<body>

    <div class="centro">
        <div class="quadradoTitulo">
            RECUPERAR SENHA
        </div>
            <x-validation-errors class="erros" />

                <form method="POST" class="entradas" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="conjuntoEntrada">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    </div>

                    <div class="conjuntoEntrada">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div class="conjuntoEntrada">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="botaoEntrar">
                            {{ __('RECUPERAR SENHA') }}
                        </x-button>
                    </div>
                </form>
        
    </div>

</body>
</html>