<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center">
            <div class="contenido">
                <h2 class="titulo_formulario">Historial de Movimientos - Otros sí</h2><br>

                <!-- Buscador -->
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar movimiento por código, acción o usuario...">

                <table class="table table-hover table-striped text-center mx-auto">
                    <thead>
                        <tr>
                            <th>Fecha y Hora</th>
                            <th>Código Otrosí</th>
                            <th>Acción</th>
                            <th>Usuario</th>
                        </tr>
                    </thead>
                    <tbody id="tablaMovimientos">
                        @foreach($movimientos as $mov)
                            <tr>
                                <td>{{ $mov->fecha_hora }}</td>
                                <td>{{ $mov->codigo_otrosi }}</td>
                                <td>{{ $mov->accion }}</td>
                                <td>{{ $mov->usuario->name ?? 'Sin usuario' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Paginación -->
                <div id="paginationLinks">
                    {{ $movimientos->links() }}
                </div>

                <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">🏠 Ir a Inicio</a>
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
                        let newRows = doc.querySelector("#tablaMovimientos").innerHTML;
                        let newPagination = doc.querySelector("#paginationLinks").innerHTML;
                        document.getElementById("tablaMovimientos").innerHTML = newRows;
                        document.getElementById("paginationLinks").innerHTML = newPagination;
                    });
            }

            // Manejo de paginación
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
    </script>

    <x-footer />
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (requerido) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</x-app-layout>

