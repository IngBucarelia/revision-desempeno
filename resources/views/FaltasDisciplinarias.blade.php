<x-app-layout>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <x-appbar />

    <div class="contenedor-principal">
        <x-sidebar />
        <div class="contenido">
            <h1 class="titulo_formulario">Zona de Faltas Disciplinarias</h1><br><br>

            <div class="grid-contenedores">
                
                <!-- Contenedor 1 -->
                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                <div class="card">
                    <h2>Por Gestionar</h2>
                    <img src="{{ asset('images/porgestionar.jpg') }}" alt="Usuarios">
                    <a style="background-color: darkgreen" href="{{ route('faltas_disciplinarias.index') }}">➡️ Ver Faltas</a>
                </div>

                <!-- Contenedor 2 -->
                <div class="card">
                    <h2>Ya Gestionadas</h2>
                    <img src="{{ asset('images/gestionada.jpg') }}" alt="Noticias">
                    <a style="background-color: darkgreen" href="{{ route('faltas_disciplinarias.gestionados') }}">➡️ Ver Faltas</a>
                </div>

                @endif

              
                <button class="btn btn-warning btn-sm" onclick="window.location='{{ route('dashboard') }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                    <i class="fas fa-edit w-100"></i>🏠 Ir a Inicio
                </button><br>
               
            </div>
        </div>
    </div>

   
 <!-- ..................................prueba de carga 27/03/2025  ..............................................................-->
    <x-footer />

</x-app-layout>
