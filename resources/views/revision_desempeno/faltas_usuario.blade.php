<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" >
            <div class="container">
                <h3 class="mb-4">Faltas Disciplinarias del Trabajador con Cédula: <spam style="color: #333" >{{ $cedula }}</spam></h3>
            
                @if($faltas->count() > 0)
                   <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Fecha de la Falta</th>
                                <th>Clase de Falta</th>
                                <th>Descripción</th>
                                <th>Testigo</th>
                                <th>Accion a Tomar</th>
                                <th>PDF</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faltas as $index => $falta)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $falta->codigo }}</td>
                                <td>{{ $falta->nombre_trabajador }}</td>
                                <td>{{ $falta->fecha_falta }}</td>
                                <td>{{ $falta->clase_falta }}</td>
                                <td>{{ $falta->descripcion_falta }}</td>                                
                                <td>{{ $falta->nombre_testigo }} - {{ $falta->cargo_testigo }}</td>
                                <td>
                                    Sanción: {{ $falta->sancion == 1 ? 'Sí' : 'No' }} <br>
                                    Descargo: {{ $falta->descargo == 1 ? 'Sí' : 'No' }} <br>
                                    Llamado: {{ $falta->llamados_atencion == 1 ? 'Sí' : 'No' }} <br>
                                    Compromiso: {{ $falta->compromiso == 1 ? 'Sí' : 'No' }} <br>
                                    Terminación: {{ $falta->terminacion_contrato == 1 ? 'Sí' : 'No' }}
                                </td>
                                <td>
                                    @if($falta->pdf_evidencia)
                                        <a href="{{ asset($falta->pdf_evidencia) }}" target="_blank">👁️ Ver PDF</a>
                                    @else
                                        No disponible
                                    @endif
                                </td>
                                <td><a href="{{ route('faltas_disciplinarias.detalle', $falta->id) }}" class="btn btn-info">👁️ Ver Detalle</a></td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   </div>
                @else
                    <div class="alert alert-info">
                        No se encontraron faltas disciplinarias registradas para esta cédula.
                    </div>
                @endif
            
                <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>
            </div>
        <br><br>

           
        </div>
       
         



        <style>
            
/* Contenedor principal */
.container {
    width: 80%;
    max-width: 800px;
    background: white;
    padding: 20px;
    margin: 20px auto;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

/* Título principal */
.titulo-principal {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

/* Secciones */
.seccion {
    border: 2px solid #ddd;
    background: #fafafa;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
}

/* Títulos de las secciones */
.titulo-seccion {
    background: #218838;
    color: white;
    padding: 10px;
    margin: -15px -15px 15px -15px;
    border-radius: 8px 8px 0 0;
    font-size: 18px;
}

/* Campos de entrada */
input, select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Botón */
.boton-guardar {
    text-align: center;
}

button {
    background: #28a745;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background: #218838;
}
        
        
/* Estilos generales */
.table-responsive {
    overflow-x: auto;
    max-width: 100%;
    margin-bottom: 1rem;
    border: 1px solid #dee2e6;
}

table {
    min-width: 1200px;
    width: auto;
    border-collapse: collapse;
    background-color: #fff;
}

th, td {
    padding: 8px 12px;
    text-align: left;
    border: 1px solid #dee2e6;
    font-size: 14px;
    white-space: normal;
    word-break: break-word;
    vertical-align: top;
}

thead {
    background-color: #d4edda;
}

/* Anchos mínimos por columna para evitar que se vean aplastadas */
th:nth-child(2), td:nth-child(2) { min-width: 120px; } /* Código */
th:nth-child(3), td:nth-child(3) { min-width: 80px; } /* Nombre */
th:nth-child(4), td:nth-child(4) { min-width: 80px; } /* Fecha de Falta */
th:nth-child(5), td:nth-child(5) { min-width: 90px; } /* Clase de Falta */
th:nth-child(6), td:nth-child(6) { min-width: 250px; } /* Descripción */
th:nth-child(7), td:nth-child(7) { min-width: 280px; } /* Testigo */
th:nth-child(8), td:nth-child(8) { min-width: 100px; } /* Acción a tomar */
th:nth-child(9), td:nth-child(9) { min-width: 100px; } /* PDF */
th:nth-child(10), td:nth-child(10) { min-width: 120px; } /* Acciones */
        
        
        
</style>
</div>

<x-footer />

</x-app-layout>

