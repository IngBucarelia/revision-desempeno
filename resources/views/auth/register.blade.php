<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <div class="login-background">
        <div class="login-container">
            <h1 class="titulo_formulario" style="text-align: center">Sistema Revisión de Desempeño</h1>
            <img src="{{ asset('images/logo.png') }}" style="width: 220px !important; margin-top:50px;" alt="Logo" class="login-logo"><br>
            <hr> <!-- Línea divisora -->

            <h2 class="subTITULO-H1" style="font-size: 30px !important">Registar Colaborador al Sistema </h2>
            <h3 >Ingrese los Datos de Usuario a Crear </h3><br><br>

            <div class="form-container">
                <form method="POST" action="{{ route('register') }}" class="formulario">
                    @csrf
            
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Nombre')" /><br>
                        <x-text-input id="name" class="login-label" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div><br>

                    <div>
                        <x-input-label for="cedula" :value="__('Cedula')" /><br>
                        <x-text-input id="name" class="login-label" type="text" name="cedula" :value="old('cedula')" required autofocus autocomplete="cedula" />
                        <x-input-error :messages="$errors->get('cedula')" class="mt-2" />
                    </div><br>
            
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Correo Electronico')" /><br>
                        <x-text-input id="email" class="login-label" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div><br>
            
                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Contraseña')" /><br>
                        <x-text-input id="password" class="login-label" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div><br>
            
                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" /><br> <span style="color: rgb(67, 139, 114)">Ingrese Nuevamente la Contraseña Anterior</span><br>
                        <x-text-input id="password_confirmation" class="login-label" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div><br>
            
                    <!-- Rol -->
                    <div class="mt-4">
                        <x-input-label for="role_id" :value="__('Asigna un Rol al nuevo usuario')" /><br>
                        <select id="role_id" name="role_id" class="login-label" required>
                            <option value="">Seleccione un rol de usuario</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                    </div><br><br><br>
            
                    <div class="botones">
                        <button class="login-button">
                            {{ __('Crear Colaborador') }}
                        </button>
                        
                    </div>
                </form>
            </div>   <br><br>         <hr> <!-- Línea divisora -->
<br>

             <a href="{{ url()->previous() }}" class="btn btn-secondary w-100" style="width: 130px !important">Atrás</a>
        </div>
    </div>    

    <style>
        /* Contenedor principal del login */
.registro-background {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f4f4f4;
}

/* Caja del formulario */
.registro-container {
    width: 450px;
    padding: 25px;
    background: white;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

/* Estilo del título */
.registro-titulo {
    font-size: 26px;
    font-weight: bold;
    margin-bottom: 10px;
}

/* Imagen del logo */
.registro-logo {
    width: 200px;
    margin-top: -20px;
}

/* Campos del formulario */
.registro-input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Botón de envío */
.registro-boton {
    background-color: #ff9800;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
}

.registro-boton:hover {
    background-color: #e68900;
}

    </style>
</x-guest-layout>
