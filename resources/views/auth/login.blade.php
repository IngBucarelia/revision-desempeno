<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    <div class="login-background" >
        <div class="login-container">
            <h1 class="TITULO-H1">Sistema de Revisión de Desempeño</h1>
            <img src="{{ asset('images/logo.png') }}" style="width: 30%" alt="Logo" class="login-logo"><br>
            <hr> <!-- Línea divisora -->

            <h3 >Proceda a Ingresar las Credenciales de Ingreso  </h3><br><br>

            <x-auth-session-status class="mb-4" :status="session('status')" />
             
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="login-label">Email</label><br>
                    <input id="email" class="login-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div><br>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="login-label">Contraseña</label><br>
                    <input id="password" class="login-input" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span class="ms-2 text-sm login-label">Recordarme</span>
                    </label>
                </div><br>

                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="login-link" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif

                    <button class="btn btn-warning btn-sm">Ingresar al Sistema </button>
                </div>
            </form><br><hr> <!-- Línea divisora -->

        </div> 
    </div>
</x-guest-layout>
