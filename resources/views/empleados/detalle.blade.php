<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />
    
        <div class="contenido">    
            <div class="container">
    
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
    
            <div class="contenido">
                <h2 class="titulo">Detalle del Empleado: {{ $empleado->nombre }}</h2>
    
                <div class="container">
                    <div class="secciones">
    
                        <!-- Sección: Información Básica -->
                        <div class="tarjeta">
                            <h3>Información Básica</h3>
                            <p><strong># Documento:</strong> {{ $empleado->codigo }}</p>
                            <p><strong>Nombre:</strong> {{ $empleado->nombre }}</p>
                            <p><strong>Correo:</strong> {{ $empleado->correo }}</p>
                            <p><strong>Teléfono:</strong> {{ $empleado->telefono }}</p>
                            <p><strong>Estado Civil:</strong> {{ $empleado->estado_civil }}</p>
                        </div>
    
                        <!-- Sección: Información Laboral -->
                        <div class="tarjeta">
                            <h3>Información Laboral</h3>
                            <p><strong>Fecha de Ingreso:</strong> {{ $empleado->fecha_ingreso }}</p>
                            <p><strong>Fecha fin Contrato :</strong> {{ $empleado->fecha_terminacion }}</p>
                            <p><strong>Labor:</strong> {{ $empleado->labor }}</p>
                            <p><strong>Periodo de Prueba:</strong> {{ $empleado->periodo_prueba ? 'Sí' : 'No' }}</p>
                            <p><strong>Número de Contrato:</strong> {{ $empleado->numero_contrato }}</p>
                        </div>
                        <div class="tarjeta">
                            <h3>Información Adicional</h3>
                            <p><strong>Rol:</strong> {{ $empleado->rol ?? 'No asignado' }}</p>
                        </div>
                    </div>
                    <br><br>
    
                    <!-- Botón para Actualizar -->
                    <div class="boton-actualizar">
                        <button>
                            <a style="color: aliceblue" href="{{ route('empleados.edit', $empleado->id) }}" class="btn-actualizar">Actualizar Información</a>
                        </button>
                    </div>
                    <br><br>
                    <button class="btn btn-warning btn-sm" onclick="window.location='{{ url()->previous() }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                        <i class="fas fa-edit"></i> Cancelar
                    </button><br>
                </div>
            </div>
        </div>
    </div>
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

