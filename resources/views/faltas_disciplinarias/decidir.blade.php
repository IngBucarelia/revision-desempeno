<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px">
            <div class="contenido">
                <h2 class="titulo_formulario">Faltas Disciplinarias por Tomar Decisión </h2><br>  
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar proceso disciplinario...">

                <table class="table table-hover table-striped text-center mx-auto">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Labor</th>
                            <th>Fecha Reporte</th>
                            <th>Fecha Falta</th>
                            <th>Tipo Falta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaFaltas">
                        @foreach($faltas as $falta)
                            <tr>
                                <td>{{ $falta->codigo }}</td>
                                <td>{{ $falta->numero_documento_trabajador }}</td>
                                <td>{{ $falta->nombre_trabajador }}</td>
                                <td>{{ $falta->labor }}</td>
                                <td>{{ $falta->fecha_reporte }}</td>
                                <td>{{ $falta->fecha_falta }}</td>
                                <td>{{ $falta->clase_falta }}</td>
                                <td>
                                    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                    <a href="{{ route('faltas_disciplinarias.Tomardesicion', $falta->id) }}" class="btn btn-warning btn-sm mb-1">👁️ Gestionar</a>
                                    @endif
                                    @if(auth()->user()->role_id == 1)
                                    <form action="{{ route('faltas_disciplinarias.destroy', $falta) }}" method="POST" class="d-inline" onsubmit="return confirmarEliminacion()">
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

                <div id="paginationLinks">
                    {{ $faltas->links() }}
                </div>

                <br>
                <a href="{{ route('faltas_disciplinarias.create') }}" class="btn btn-success"> 📝 Crear Nueva Falta Disciplinaria</a><br>
                <a href="{{ route('faltas_disciplinarias.buscar') }}" class="btn btn-info"> 🔍 Buscar Falta Disicplinaria</a><br>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary"> 🏠 Ir a Inicio</a>
            </div>
        </div>
    </div>

    <x-footer />
    
    <script>
        // Script para mostrar mensajes de éxito si existen
        @if(session('success'))
            setTimeout(() => {
                const successAlert = document.querySelector('.alert-success');
                if (successAlert) {
                    successAlert.style.display = 'none';
                }
            }, 5000); // 5000 milisegundos = 5 segundos
        @endif
        
        // Script de descarga del PDF
        @if(session('pdf_download_id'))
            document.addEventListener('DOMContentLoaded', function() {
                const descargoId = "{{ session('pdf_download_id') }}";
                const pdfUrl = "{{ route('faltas_disciplinarias.descargos_pdf', ['id' => ':id']) }}".replace(':id', descargoId);
                
                const link = document.createElement('a');
                link.href = pdfUrl;
                link.target = '_blank';
                link.style.display = 'none';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        @endif
        
        // Buscador y paginación AJAX
        document.addEventListener("DOMContentLoaded", function () {
            function fetch_data(page, query = '') {
                fetch(`{{ route('faltas_disciplinarias.pordesicion') }}?page=${page}&search=${query}`)
                    .then(response => response.text())
                    .then(data => {
                        let parser = new DOMParser();
                        let doc = parser.parseFromString(data, 'text/html');
                        let newRows = doc.querySelector("#tablaFaltas").innerHTML;
                        let newPagination = doc.querySelector("#paginationLinks").innerHTML;
                        document.getElementById("tablaFaltas").innerHTML = newRows;
                        document.getElementById("paginationLinks").innerHTML = newPagination;
                    });
            }

            document.addEventListener("click", function (e) {
                if (e.target.closest(".pagination a")) {
                    e.preventDefault();
                    let page = e.target.getAttribute("href").split("page=")[1];
                    let query = document.getElementById("searchInput").value;
                    fetch_data(page, query);
                }
            });

            document.getElementById("searchInput").addEventListener("keyup", function () {
                let query = this.value;
                fetch_data(1, query);
            });
        });

        function confirmarEliminacion() {
            return confirm("¿Estás seguro de que deseas eliminar esta falta disciplinaria?");
        }
    </script>
</x-app-layout>