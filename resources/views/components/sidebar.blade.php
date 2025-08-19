<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">


<div class="sidebar">
    <h1 class="subTITULO-H1" style="font-size: 20px !important;">
        Sistema  <br>Revisión <br> Desempeño
    </h1>
    <hr>

    <div class="accordion-wrapper">

        <div class="accordion">
            <div class="accordion-label" onclick="toggleAccordion(this)">Inicio</div>
            <div class="accordion-content">
                <li><a class="ul_slider_text" href="{{ route('dashboard') }}">Ir a Inicio</a></li>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-label" onclick="toggleAccordion(this)">Revisión <br>Desempeño</div>
            <div class="accordion-content">
                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                <li><a class="ul_slider_text" href="{{ route('revision_desempeno.index') }}">Ver Lista</a></li>
                <li><a class="ul_slider_text" href="{{ route('revision_desempeno.create') }}">Crear Nuevo</a></li>
                @endif

                @auth
                    @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 1)
                        <li><a class="ul_slider_text" href="{{ route('revision_desempeno.lista.gh') }}">Pendientes GH</a></li>
                    @endif
                    @if(auth()->user()->role_id == 3 || auth()->user()->role_id == 1)
                        <li><a class="ul_slider_text" href="{{ route('revision_desempeno.lista.sst') }}">Pendientes SST</a></li>
                    @endif
                    @if(auth()->user()->role_id == 4 || auth()->user()->role_id == 1)
                        <li><a class="ul_slider_text" href="{{ route('revision_desempeno.lista.jefe') }}">Pendientes Jefe</a></li>
                    @endif
                    @if(auth()->user()->role_id == 1)
                        <li><a class="ul_slider_text" href="{{ route('revision_desempeno.lista.gerencia') }}">Revisa gerencia</a></li>
                    @endif
                @endauth

                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 )
                    <li><a class="ul_slider_text" href="{{ route('revision_desempeno.lista.terminados') }}">Si Cumple</a></li>
                    <li><a class="ul_slider_text" href="{{ route('revision_desempeno.lista.terminadosNo') }}">No Cumple</a></li>
                    <li><a class="ul_slider_text" href="{{ route('revision_desempeno.movimiento_revision') }}">Movimientos</a></li>
                    
                @endif
            </div>
        </div>
        <div class="accordion-content">
                <li >
                    
                </li>

        </div>

        <div class="accordion">
            <div class="accordion-label" onclick="toggleAccordion(this)">Novedades <br> Contrato</div>
            <div class="accordion-content">
                <li><a class="ul_slider_text" href="{{ route('novedades_contrato.index') }}">
                        <i class="fas fa-file-signature"></i>Ver Lista
                    </a></li>
                <li><a class="ul_slider_text" href="{{ route('novedades_contrato.movimiento_novedades') }}">Movimientos</a></li>
                 
            </div>
        </div>

        @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 7)
        <div class="accordion">
            <div class="accordion-label" onclick="toggleAccordion(this)">Faltas <br>Disciplinarias</div>
            <div class="accordion-content">
                <li><a class="ul_slider_text" href="{{ route('faltas_disciplinarias.index') }}">Por Gestionar</a></li>
                <li><a class="ul_slider_text" href="{{ route('faltas_disciplinarias.enDescargos') }}">En Descargos</a></li>
                 <li><a class="ul_slider_text" href="{{ route('faltas_disciplinarias.pordesicion') }}">Por Tomar desición</a></li>
                 <li><a class="ul_slider_text" href="{{ route('faltas_disciplinarias.primeraDesicion') }}">Primera Desición</a></li>
                 <li><a class="ul_slider_text" href="{{ route('faltas_disciplinarias.apelacion') }}">En Apelación</a></li>
                 <li><a class="ul_slider_text" href="{{ route('faltas_disciplinarias.gestionados') }}">Desición Final</a></li>
                <li><a class="ul_slider_text" href="{{ route('faltas_disciplinarias.create') }}">Crear Nuevo</a></li>
                <li><a class="ul_slider_text" href="{{ route('faltas_disciplinarias.buscar') }}">Buscar</a></li>
                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 )
                <li><a class="ul_slider_text" href="{{ route('faltas_disciplinarias.movimiento_faltas') }}">Historial</a></li>
                <li><a href="/procesos/importar">Importar CSV</a></li>
                @endif
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-label" onclick="toggleAccordion(this)">llamados <br> Recordatorios</div>
            <div class="accordion-content">
                <li><a class="ul_slider_text" href="{{ route('llamados_atencion.index') }}">Ver Lista</a></li>
                <li><a class="ul_slider_text" href="{{ route('llamados_atencion.create') }}">Crear Nuevo</a></li>
                <li><a class="ul_slider_text" href="{{ route('llamados_atencion.buscar') }}">Buscar</a></li>
                 @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 )
                <li><a class="ul_slider_text" href="{{ route('llamados_atencion.movimiento_llamados') }}">Historial</a></li>
                <li><a href="/llamados/importar">Importar CSV</a></li>
                @endif
            </div>
        </div>
        @endif
         @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 )
        

        <div class="accordion">
            <div class="accordion-label" onclick="toggleAccordion(this)">Otros <br>Si</div>
            <div class="accordion-content">
                <li><a class="ul_slider_text" href="{{ route('otrosis.index') }}">Ver Lista</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('otrosi.movimientos') }}">
                        <i class="fas fa-history"></i> Movimientos Otrosí
                    </a>
                </li>

                
                 
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-label" onclick="toggleAccordion(this)">Empleados</div>
            <div class="accordion-content">
                <li><a class="ul_slider_text" href="{{ route('empleado.perfil') }}">Mi Perfil</a></li>
                <li><a class="ul_slider_text" href="{{ route('empleados.porRol') }}">Empleado por Rol</a></li>
                <li><a class="ul_slider_text" href="{{ route('empleados.index') }}">Ver Lista</a></li>
                <li><a class="ul_slider_text" href="{{ route('empleados.create') }}">Agregar Nuevo</a></li>
                <li><a class="ul_slider_text" href="/empleados/importar">Importar</a></li>
                <li><a class="ul_slider_text" href="{{ route('prorrogas.index') }}">Prorrogas</a></li>
                <li><a class="ul_slider_text" href="{{ route('inasistencias.index') }}">Inasistencias</a></li>
                <li><a class="ul_slider_text" href="{{ route('suspensiones.index') }}">Suspenciones</a></li>
            </div>
        </div>
        <div class="accordion">
            <div class="accordion-label" onclick="toggleAccordion(this)">Colaboradores</div>
            <div class="accordion-content">
                <li><a class="ul_slider_text" href="{{ route('usuarios.index') }}">Ver Lista</a></li>
                <li><a class="ul_slider_text" href="{{ route('register') }}">Agregar Nuevo</a></li>
            </div>
        </div>
        @endif

    </div><br>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <hr><br><br>

    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="block p-2 hover:bg-red-700 text-center bg-red-600 rounded"
       style="margin-bottom: 5px !important; background:#ab4d1a; color: aliceblue">
       🔚 Salir del Sistema
    </a>
</div>

<script>
    function toggleAccordion(element) {
        const allAccordions = document.querySelectorAll('.accordion-content');
        const content = element.nextElementSibling;

        if (content.classList.contains('open')) {
            content.classList.remove('open');
        } else {
            allAccordions.forEach(acc => acc.classList.remove('open'));
            content.classList.add('open');
        }
    }
</script>

<style>
.accordion-wrapper {
    width: 220px;
    margin: auto;
}
.accordion {
    background: #135b13;
    color: white;
    margin-bottom: 8px;
    border-radius: 5px;
}
.accordion-label {
    padding: 12px;
    cursor: pointer;
    font-weight: bold;
    background-color: #145214;
    border-bottom: 1px solid #0d330d;
}
.accordion-content {
    display: none;
    background-color: #1d4d1d;
    color: white;
    padding: 0 12px;
}
.accordion-content.open {
    display: block;
}
.accordion-content li {
    list-style: none;
}
.ul_slider_text {
    display: block;
    padding: 8px;
    color: white;
    background-color: #2a7c2a;
    text-decoration: none;
    margin: 2px 0;
}
.ul_slider_text:hover {
    background-color: #1c501c;
}
</style>

