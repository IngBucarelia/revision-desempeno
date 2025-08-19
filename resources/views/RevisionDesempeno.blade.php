<x-app-layout>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <x-appbar />

    <div class="contenedor-principal">
        <x-sidebar />
        <div class="contenido">
            <h1 class="titulo_formulario">Revisión de Desempeño</h1><br><br>

            <div class="grid-contenedores">
                <div class="card">
                    <h2>Administrar Revisión</h2>
                    <img src="{{ asset('images/revisiondesempeno.png') }}" style="margin-top: 10px" alt="Reportes"> <br><br>
                    <div class="accordion">
                        <div class="accordion-header" style="height: 33px;margin-top:10px;" onclick="toggleAccordion(this)">
                           ➡️ Administrar Revisión
                        </div>
                        <ul class="accordion-content" style="margin-bottom: 30pxs">
                           
                            @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 1)
                              
                             <li><a href="{{ route('revision_desempeno.create') }}">➡️ Crear Nuevo</li></a>
                            
                                <li><a href="{{ route('revision_desempeno.index') }}">➡️ Ver Lista</li></a>
                              @endif
                          
                           
                            @if (auth()->user()->role_id == 1 )
                                <li><a href="{{ route('revision_desempeno.lista.terminados') }}">➡️ Terminadas</a></li>
                            
                    
                            <li><a href="{{ route('revision_desempeno.movimiento_revision') }}"> ➡️ Movimientos</a></li>
                            <li><a href="{{ route('revision_desempeno.lista.terminados') }}"> ➡️ Aprobadas</a></li>
                            <li><a href="{{ route('revision_desempeno.lista.terminadosNo') }}"> ➡️ No Aprobadas</a></li>
                            
                            @endif
                        </ul>
                    </div>
                    
                    <script>
                    function toggleAccordion(header) {
                        const content = header.nextElementSibling;
                        content.classList.toggle('open');
                    }
                    </script>
                    </div>

                  @if (auth()->user()->role_id == 3 || auth()->user()->role_id == 1)
                <div class="card">
                    <h2>Pendientes Gestion Humana</h2>
                    <img src="{{ asset('images/gh.jpg') }}" alt="Reportes">
                    <a style="background-color: darkgreen" href="{{ route('revision_desempeno.lista.gh') }}">➡️ Ver Pendientes GH</a>
                </div>
                 @endif
                <!-- Contenedor 4 -->
                @if (auth()->user()->role_id == 3 || auth()->user()->role_id == 1)
                <div class="card">
                    <h2>Pendientes SST</h2>
                    <img src="{{ asset('images/sst.jpg') }}" alt="Reportes">
                    <a style="background-color: darkgreen" href="{{ route('revision_desempeno.lista.sst') }}">➡️ Ver Pendientes SST</a>
                </div>
                 @endif
                <!-- Contenedor 1 -->
                @if (auth()->user()->role_id == 4 || auth()->user()->role_id == 1)
                <div class="card">
                    <h2>Pendientes Jefe</h2>
                    <img src="{{ asset('images/jefe.jpg') }}" alt="Usuarios">
                    <a style="background-color: darkgreen" href="{{ route('revision_desempeno.lista.jefe') }}">➡️ Ver Pendientes Jefe</a>
                </div>
                  @endif
                <!-- Contenedor 2 -->

                 @if (auth()->user()->role_id == 5 || auth()->user()->role_id == 1)                              
                <div class="card">
                    <h2>Revisa Gerencia</h2>
                    <img src="{{ asset('images/gerencia.jpg') }}" alt="Noticias">
                    <a style="background-color: darkgreen" href="{{ route('revision_desempeno.lista.gerencia') }}">➡️ Ver Revisa Gerencia</a>
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
