<x-app-layout>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <x-appbar />

    <div class="contenedor-principal">
        <x-sidebar />
        <div class="contenido">
            
            <h1 class="titulo_formulario">Zona de Colaboradores y Empleados</h1><br><br>

            <div class="grid-contenedores">
                
                <!-- Contenedor 1 -->
                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                 <div class="card">
                    <h2>Gestión de Colaboradores</h2>
                    <img src="{{ asset('images/colaboradores.jpg') }}" alt="Noticias">
                    <a style="background-color: darkgreen" href="{{ route('usuarios.index') }}">➡️ Ver Colaboradores</a>
                </div>

                <!-- Contenedor 2 -->
                 <div class="card">
                    <h2>Gestión de Empleados</h2>
                    <img src="{{ asset('images/empleados.jpg') }}" alt="Noticias">
                    <a style="background-color: darkgreen" href="{{ route('empleados.index') }}">➡️ Ver Empleados</a>
                </div>

                @endif

              
                <a class="btn btn-warning btn-sm" href="{{ route('dashboard') }}" style="margin-bottom: 5px !important; background:#ab4d1a;">
                    <i class="fas fa-edit w-100"></i>🏠 Ir a Inicio
                </a><br>
               
            </div>
        </div>
    </div>

   
 <!-- ..................................prueba de carga 27/03/2025  ..............................................................-->
    <x-footer />

</x-app-layout>
