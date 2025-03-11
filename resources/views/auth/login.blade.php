<x-guest-layout>
    <div class="centro">
        <div class="quadradoTitulo">
            FAZER LOGIN
        </div>

        <!-- Exibição de erros de validação -->
        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form class="formularioLogin" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="entradas">
                <div class="conjuntoEntrada">
                    <label for="email">EMAIL</label>
                    <input type="email" id="email" name="email" class="input" value="{{ old('email') }}" required autofocus autocomplete="username">
                </div>

                <div class="conjuntoEntrada">
                    <label for="password">SENHA</label>
                    <input type="password" id="password" name="password" class="input" required autocomplete="current-password">
                </div>
            </div>

            <div class="lembrar">
                <input type="checkbox" id="remember_me" name="remember">
                <label for="remember_me">LEMBRAR DE MIM</label>
            </div>

            <button type="submit" class="botaoEntrar">ENTRAR</button>

            <div class="escritoFinal">
                <p>Não possui uma conta? <a href="{{ route('register') }}">Cadastre-se</a></p>
                <p><a href="{{ route('password.request') }}">Recuperar conta</a></p>
            </div>
        </form>
    </div>
</x-guest-layout>
