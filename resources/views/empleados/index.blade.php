<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="contenido">
            <div class="container" style="margin-left: 50px; margin-bottom: 300px;">
                <h1 class="titulo_formulario">Listado de Empleados</h1>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Buscador en tiempo real -->
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar empleado...">

                <div class="table">
                    <table class="table table-hover table-striped text-center mx-auto">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaEmpleados">
                            @foreach($empleados as $empleado)
                            <tr>
                                <td>{{ $empleado->id }}</td>
                                <td>{{ $empleado->codigo }}</td>
                                <td>{{ $empleado->nombre }}</td>
                                <td>{{ $empleado->correo }}</td>
                                <td>{{ $empleado->telefono }}</td>
                                <td>

                                    <button class="btn btn-warning btn-sm" onclick="window.location='{{ route('empleados.detalle', ['id' => $empleado->id]) }}'" style="margin-bottom: 5px;">
                                        <i class="fas fa-eye"></i>👁️ Ver Detalle
                                    </button>
                                    <button class="btn btn-warning btn-sm" onclick="window.location='{{ route('empleados.edit', $empleado->id) }}'" style="margin-bottom: 5px !important;">
                                        <i class="fas fa-edit"></i>✏️ Editar
                                    </button><br>                                  

                                    <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" class="form-eliminar">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')" style="margin-bottom: 5px !important; background:#ab4d1a;">
                                            <i class="fas fa-trash-alt"></i>🗑️ Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Links de paginación -->
                    <div id="paginationLinks">
                        {{ $empleados->links() }}
                    </div>

                    <br>
                    <button class="btn btn-warning btn-sm" onclick="window.location='{{ route('empleados.create') }}'" style="margin-bottom: 5px !important;">
                        <i class="fas fa-edit"></i>➕ Crear Nuevo Empleado
                    </button><br>
                    <button class="btn btn-warning btn-sm" onclick="window.location='{{ route('dashboard') }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                        <i class="fas fa-edit"></i>🏠 Ir a Inicio
                    </button><br>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para búsqueda y paginación AJAX -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function fetch_data(page, query = '') {
                fetch(`?page=${page}&search=${query}`)
                    .then(response => response.text())
                    .then(data => {
                        let parser = new DOMParser();
                        let doc = parser.parseFromString(data, 'text/html');
                        let newRows = doc.querySelector("#tablaEmpleados").innerHTML;
                        let newPagination = doc.querySelector("#paginationLinks").innerHTML;
                        document.getElementById("tablaEmpleados").innerHTML = newRows;
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

            // Buscador predictivo
            document.getElementById("searchInput").addEventListener("keyup", function () {
                let query = this.value;
                fetch_data(1, query);
            });
        });
    </script>

    <x-footer />
</x-app-layout>
