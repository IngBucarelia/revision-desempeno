<x-app-layout>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <x-appbar />

    <div class="contenedor-principal">
        <x-sidebar />
        <div class="contenido">
            <div class="box">
                <div class="inner">
                    <span> 📋REVISIÓN DE</span>
                </div>
                <div class="inner">
                    <span>DESEMPEÑO📋</span>
                </div>
                </div><br><br>
           

            <div class="grid-contenedores">
                <div class="card">
                    <h2>Revision de Desempeño</h2>
                    <img src="{{ asset('images/revisiondesempeno.png') }}" style="margin-top: 10px" alt="Reportes"> <br><br>
              
                        <a style="background-color: darkgreen" href="{{ route('RevisionDesempeno') }}">➡️ Ir a Revisiones de 
                            DEsempeño
                        </a>
                       
                  
                  
                    </div>

                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 7)
                <div class="card">
                    <h2>Faltas Disciplinarias</h2>
                    <img src="{{ asset('images/llamados.jpg') }}"  style="margin-top: 10px"   alt="Configuración">
                    <a style="background-color: darkgreen" href="{{ route('FaltasDisciplinarias') }}">➡️ Ir a Faltas Disciplinarias</a>
                </div>
                <!-- Contenedor 4 -->
                <div class="card">
                    <h2>Recordatorios y Llamados</h2>
                    <img src="{{ asset('images/recordatorios.jpg') }}" alt="Reportes">
                    <a style="background-color: darkgreen" href="{{ route('llamados_atencion.index') }}">➡️ Ir a Recordatorios y Llamados</a>
                </div>
                @endif
                <!-- Contenedor 1 -->
                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                <div class="card">
                    <h2>Colaboradores y Empleados</h2>
                    <img src="{{ asset('images/colaboradores.jpg') }}" alt="Usuarios">
                    <a style="background-color: darkgreen" href="{{ route('EmpleadosColaboradores') }}">➡️ Ver Colaboradores y Empleados</a>
                </div>

                <!-- Contenedor 2 -->
               

                @endif

              
               
            </div>
        </div>
    </div>

   
 <!-- ..................................prueba de carga 27/03/2025  ..............................................................-->
    <x-footer />

</x-app-layout>
