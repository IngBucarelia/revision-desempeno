<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px">
            <div class="contenido">
                <h2 class="titulo_formulario">Listado de Inasistencias</h2><br>

                <!-- Buscador en tiempo real -->
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar por cédula, código o fecha...">

                <table class="table table-hover table-striped text-center mx-auto">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Fecha Registro</th>
                            <th>Cédula</th>
                            <th>Código Falta</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Total Días</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaInasistencias">
                        @foreach($inasistencias as $inasistencia)
                            <tr>
                                <td>{{ $inasistencia->id }}</td>
                                <td>{{ $inasistencia->fecha_registro }}</td>
                                <td>{{ $inasistencia->cedula }}</td>
                                <td>{{ $inasistencia->codigo_falta }}</td>
                                <td>{{ $inasistencia->fecha_inicio }}</td>
                                <td>{{ $inasistencia->fecha_fin }}</td>
                                <td>{{ $inasistencia->total_dias }}</td>
                                <td>
                                    <form action="{{ route('inasistencias.destroy', $inasistencia->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar inasistencia?')">🗑️ Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Links de paginación -->
                <div id="paginationLinks">
                    {{ $inasistencias->links() }}
                </div>

                <br>
                <a href="{{ route('inasistencias.create') }}" class="btn btn-success">📝 Registrar Nueva Inasistencia</a><br>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">🏠 Ir a Inicio</a>
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
                        let newRows = doc.querySelector("#tablaInasistencias").innerHTML;
                        let newPagination = doc.querySelector("#paginationLinks").innerHTML;
                        document.getElementById("tablaInasistencias").innerHTML = newRows;
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
            return confirm("¿Estás seguro de que deseas eliminar esta inasistencia?");
        }
    </script>

    <x-footer />
</x-app-layout>