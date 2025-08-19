<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px">
            <div class="contenido">
                <h2 class="titulo_formulario">Listado de Recordatorios y Llamados</h2><br>

                <!-- Buscador en tiempo real -->
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar llamado de atención...">

                <table class="table table-hover table-striped text-center mx-auto">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Trabajador</th>
                            <th>Fecha de Notificación</th>
                            <th>Clase de Falta </th>
                            <th>Labor </th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaLlamados">
                        @foreach($llamados as $llamado)
                            <tr>
                                <td>{{ $llamado->codigo }}</td>
                                <td>{{ $llamado->trabajador }}</td>
                                <td>{{ $llamado->fecha_notificacion }}</td>
                                <td>{{ $llamado->clase_falta }}</td>
                                <td>{{ $llamado->labor }}</td>
                                <td>
                                    <a href="{{ route('llamados_atencion.detalle', $llamado->id) }}" class="btn btn-info">👁️ Ver Detalle</a>
                                    
                                    @if(auth()->user()->role_id == 1 )
                                    <a href="{{ route('llamados_atencion.edit', $llamado->id) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
                                    <form action="{{ route('llamados_atencion.destroy', $llamado->id) }}" method="POST" class="d-inline" onsubmit="return confirmarEliminacion()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">🗑️ Eliminar</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Links de paginación -->
                <div id="paginationLinks">
                    {{ $llamados->links() }}
                </div>

                <br>
                <a href="{{ route('llamados_atencion.create') }}" class="btn btn-success">📄 Crear Nuevo Llamado</a><br>
                <a href="{{ route('llamados_atencion.buscar') }}" class="btn btn-info">🔍 Buscar Llamado</a><br>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">🏠	Ir a Inicio</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function fetch_data(page, query = '') {
                fetch(`?page=${page}&search=${query}`)
                    .then(response => response.text())
                    .then(data => {
                        let parser = new DOMParser();
                        let doc = parser.parseFromString(data, 'text/html');
                        let newRows = doc.querySelector("#tablaLlamados").innerHTML;
                        let newPagination = doc.querySelector("#paginationLinks").innerHTML;
                        document.getElementById("tablaLlamados").innerHTML = newRows;
                        document.getElementById("paginationLinks").innerHTML = newPagination;
                    });
            }

            // Manejar cambio de página
            document.addEventListener("click", function (e) {
                if (e.target.closest(".pagination a")) {
                    e.preventDefault();
                    let page = e.target.getAttribute("href").split("page=")[1];
                    let query = document.getElementById("searchInput").value;
                    fetch_data(page, query);
                }
            });

            // Buscador en tiempo real
            document.getElementById("searchInput").addEventListener("keyup", function () {
                let query = this.value;
                fetch_data(1, query);
            });
        });

        function confirmarEliminacion() {
            return confirm("¿Estás seguro de que deseas eliminar este llamado?");
        }
    </script>

    <x-footer />
</x-app-layout>
