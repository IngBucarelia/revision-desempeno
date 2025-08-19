<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" >
            <div class="contenido" >    
                <h2 class="titulo_formulario">Crear Revisión de Desempeño</h2>
                <form method="POST" action="{{ route('revision_desempeno.store') }}">
                    @csrf
                    <div class="card mb-4" style="height: 700px !important;">
                        <div class="card-header bg-success text-white">Información General</div>
                        <div class="card-body">
                            <div class="row mb-3">
                              <div class="col-md-6">
                                    <label for="fecha_solicitud">Fecha Solicitud</label>
                                    <input type="date" name="fecha_solicitud" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="nombre_trabajador"># Documento</label>
                                    <input type="number" name="cedula" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nombre_trabajador">Nombre Trabajador</label>
                                    <input type="text" name="nombre_trabajador" class="form-control" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="cargo">Cargo</label>
                                    <input type="text" name="cargo" class="form-control" readonly>
                                </div>
                            </div><br>
                            <div class="row mb-3">
                                
                                <div class="col-md-6">
                                    <label for="fecha_ingreso">Fecha Ingreso</label>
                                    <input type="text" name="fecha_ingreso" class="form-control" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="fecha_ingreso">Fecha Terminación de Contrato</label>
                                    <input type="text" name="fecha_terminacion" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="prorrogas">Prórrogas</label>
                                    <div class="input-group">
                                        <input type="text" name="prorrogas" class="form-control" readonly>
                                        <a id="verProrrogasBtn" href="#" target="_blank" class="btn btn-info" style="display: none;">Ver</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="fecha_vencimiento">Fecha Vencimiento ultima prorroga</label>
                                    <input type="date" name="fecha_vencimiento" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="asignado_gh">Asignado a Gestión Humana</label>
                                    <select name="asignado_gh" class="form-control" required>
                                        <option value="">Seleccione</option>
                                        @foreach($empleadosGestionHumana as $empleadoGH)
                                            <option value="{{ $empleadoGH->id }}">{{ $empleadoGH->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="elaborado_por">Elaborado Por:</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                    <input type="hidden" name="elaborado_por" value="{{ Auth::user()->id }}">
                                </div><br><br>
                                <div class="col-md-6" style="margin-top: 40px">
                                    <label for="fecha_vencimiento"><span style="color: #218838">Estado de Revision</span></label>
                                    <input hidden type="text" name="estado" class="form-control" value="gh" placeholder="Pendiente Gestion Humana" readonly>
                                    <p>Pendiente Gestion Humana</p>
                                </div>
                                
                            </div>
                            <button type="submit" class="btn btn-success">💾 Guardar y Continuar</button>
                        </div> <button class="btn btn-warning btn-sm" onclick="window.location='{{ url()->previous() }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                            <i class="fas fa-edit"></i>🚫 Cancelar
                        </button><br>
                    </div>
                </form>
                
                       
        


            <!-- Modal de Registro Exitoso -->
            <div class="modal fade" id="registroExitoso" tabindex="-1" aria-labelledby="registroExitosoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="registroExitosoLabel">Registro Exitoso</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            ¡Tu registro se ha completado con éxito!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
           

            <style>
                .grid-container {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    gap: 10px;
                }
                .grid-item {
                    display: flex;
                    flex-direction: column;
                }
                .textarea-estilizado {
            width: 100%; /* Ocupa todo el ancho disponible */
            max-width: 600px; /* Ancho máximo */
            height: 150px; /* Aumenta la altura */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical; /* Permite redimensionar solo en vertical */
            font-size: 14px;
            font-family: Arial, sans-serif;
        }

        /* Opcional: Estilo cuando el usuario hace clic */
        .textarea-estilizado:focus {
            border-color: #007bff; /* Color azul al hacer clic */
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

            </style>
        </div>
        <br><br>

           
        </div>
        <script>
            document.querySelector('input[name="cedula"]').addEventListener('change', function () {
                const documento = this.value;
            
                // Buscar datos del empleado
                fetch(`/buscar-empleado/${documento}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'found') {
                            document.querySelector('input[name="cedula"]').value = data.empleado.codigo;
                            document.querySelector('input[name="nombre_trabajador"]').value = data.empleado.nombre;
                            document.querySelector('input[name="cargo"]').value = data.empleado.labor ?? '';
                            document.querySelector('input[name="fecha_ingreso"]').value = data.empleado.fecha_ingreso;
                            document.querySelector('input[name="fecha_terminacion"]').value = data.empleado.fecha_terminacion;
                        } else {
                            alert('El usuario no existe. Por favor crear empleado para continuar.');
                            window.location.href = '/empleados/create';
                        }
                    });
            
                // Buscar prorrogas
                fetch(`/buscar-prorrogas/${documento}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'found') {
                            document.querySelector('input[name="prorrogas"]').value = data.total;
                            document.querySelector('input[name="fecha_vencimiento"]').value = data.ultima_fecha;
                            const btn = document.getElementById('verProrrogasBtn');
                            btn.href = data.detalle_url;
                            btn.style.display = 'inline-block';
                        } else {
                            document.querySelector('input[name="prorrogas"]').value = 0;
                            document.querySelector('input[name="fecha_vencimiento"]').value = '';
                            document.getElementById('verProrrogasBtn').style.display = 'none';
                        }
                    });
            });
            </script>
            
            @if (session('errores'))
            <div class="alert alert-warning">
                <strong>Errores durante la importación:</strong>
                <ul>
                    @foreach (session('errores') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @if (session('log_file'))
                    <a href="{{ url('descargar-log/' . session('log_file')) }}" class="btn btn-sm btn-outline-primary mt-2">
                        Descargar registro de errores
                    </a>
                @endif
            </div>
        @endif
        
        <script>
            document.querySelector('input[name="cedula"]').addEventListener('change', function () {
                const documento = this.value;
            
                fetch(`/buscar-empleado/${documento}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'found') {
                            document.querySelector('input[name="codigo"]').value = data.empleado.numero_contrato;
                            document.querySelector('input[name="numero_documento_trabajador"]').value = data.empleado.codigo;
                            document.querySelector('input[name="nombre_trabajador"]').value = data.empleado.nombre;
                            document.querySelector('input[name="labor"]').value = data.empleado.labor ?? ''; // si no hay, queda vacío
                        } else {
                            alert('El usuario no existe. Por favor crear empleado para continuar .');
                            window.location.href = '/empleados/create'; // ajusta a tu ruta real
                        }
                    });
            });
            </script>    



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
</div>
<x-footer />

</x-app-layout>

