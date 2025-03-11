<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    @vite('resources/css/registro.css')
</head>
<body>
    
</body>
</html>
    <div class="centro">
        <div class="quadradoTitulo">
            CRIAR CONTA
        </div>

        <!-- Exibição de erros de validação -->
        <x-validation-errors class="mb-4" />

        <form method="POST" class="formularioEnviar" action="{{ route('register') }}">
            @csrf

            <div class="entradas">
                <div class="conjuntoEntrada">
                    <label for="name">NOME</label>
                    <input type="text" id="name" name="name" class="input" value="{{ old('name') }}" required autofocus autocomplete="name">
                </div>

                <div class="conjuntoEntrada">
                    <label for="email">EMAIL</label>
                    <input type="email" id="email" name="email" class="input" value="{{ old('email') }}" required autocomplete="username">
                </div>

                <div class="conjuntoEntrada">
                    <label for="password">SENHA</label>
                    <input type="password" id="password" name="password" class="input" required autocomplete="new-password">
                </div>

                <div class="conjuntoEntrada">
                    <label for="password_confirmation">CONFIRMAR SENHA</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="input" required autocomplete="new-password">
                </div>
            </div>

            <button type="submit" class="botaoEntrar">CADASTRAR</button>

            <div class="escritoFinal">
                <p>Já possui uma conta? <a href="{{ route('login') }}">Entrar</a></p>
            </div>
        </form>
    </div>

</body>
</html>
