<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" >
            <div class="container">
                <h3 class="mb-4">Suspenciones Registradas del Trabajador con Cédula: <spam style="color: #333" >{{ $cedula }}</spam></h3>
            
                @if($faltas->count() > 0)
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                
                                <th>Código</th>
                                <th>Fecha Registro</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Total Dias</th>
                                <th>Fecha Creacion</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faltas as $index => $falta)
                            <tr>
                               
                                <td>{{ $falta->id }}</td>
                                <td>{{ $falta->fecha_registro }}</td>
                                <td>{{ $falta->fecha_inicio }}</td>
                                <td>{{ $falta->fecha_fin }}</td>                                
                                <td>{{ $falta->total_dias }}</td>
                                <td>{{ $falta->created_at }}</td>
                             
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
        </style>
</div>

<x-footer />

</x-app-layout>

