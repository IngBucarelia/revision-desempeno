<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />
       
        <div class="contenido">    
        <div class="container">
    <h3 class="titulo_formulario">Listado de Otrosís</h3>
    <div class="mb-3">
        <input style="width: 600px" type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre o código de empleado...">
    </div>
    <table class="table table-bordered">
        <thead class="table-success">
            <tr>
                <th>#</th>
                <th>Empleado</th>
                <th>Documento</th>
                <th>Fecha Renovación</th>
                <th>Periodo</th>
                <th>Prórroga</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaOtrosis">
            @foreach($otrosis as $otrosi)
            <tr>
                <td>{{ $otrosi->id }}</td>
                <td>{{ $otrosi->empleado->nombre }}</td>
                <td>{{ $otrosi->codigo_trabajador }}</td>
                <td>{{ $otrosi->fecha_renovacion }}</td>
                <td>{{ $otrosi->periodo }}</td>
                <td>{{ $otrosi->numero_prorrogas }}</td>
                <td>
                    <a href="{{ route('otrosis.show', $otrosi->id) }}" class="btn btn-outline-primary btn-sm"> 👁️ Ver</a>
                    <a href="{{ route('otrosis.edit', $otrosi->id) }}" class="btn btn-warning btn-sm">✏️ Editar</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div id="paginationLinks">
    {{ $otrosis->links() }}
    <button class="btn btn-warning btn-sm" onclick="window.location='{{ route('dashboard') }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                    <i class="fas fa-edit w-100"></i>🏠 Ir a Inicio
                </button><br>
</div>

</div>

        </div>
    </div>

    <x-footer />
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (requerido) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        function fetchOtrosis(page = 1, query = '') {
            fetch(`?page=${page}&search=${encodeURIComponent(query)}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const htmlDoc = parser.parseFromString(data, 'text/html');
                const newTable = htmlDoc.querySelector("#tablaOtrosis");
                const newPagination = htmlDoc.querySelector("#paginationLinks");

                if (newTable && newPagination) {
                    document.querySelector("#tablaOtrosis").innerHTML = newTable.innerHTML;
                    document.querySelector("#paginationLinks").innerHTML = newPagination.innerHTML;
                }
            });
        }

        // Buscar mientras escribe
        document.getElementById("searchInput").addEventListener("keyup", function () {
            fetchOtrosis(1, this.value);
        });

        // Cambiar página
        document.addEventListener("click", function (e) {
            if (e.target.closest(".pagination a")) {
                e.preventDefault();
                const href = e.target.getAttribute("href");
                const page = new URL(href).searchParams.get("page");
                const query = document.getElementById("searchInput").value;
                fetchOtrosis(page, query);
            }
        });
    });
</script>

</x-app-layout>

