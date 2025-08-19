<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar /> 

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px">
            <div class="contenido">    
                <h2>Revisión de Desempeño - Zona Gestion Humana</h2>
                <table class="table table-bordered table-striped text-center mx-auto mb-4">
                    <tr>
                        <td colspan="4" style="background-color: rgba(128, 128, 128, 0.1); font-weight: bold;">Información General</td>
                    </tr>
                    <tr>
                        <td><strong>Fecha Solicitud</strong></td>
                        <td>{{ $revision->fecha_solicitud }}</td>
                        <td><strong>Cédula</strong></td>
                        <td>{{ $revision->cedula }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nombre Trabajador</strong></td>
                        <td>{{ $revision->nombre_trabajador }}</td>
                        <td><strong>Cargo</strong></td>
                        <td>{{ $revision->cargo }}</td>
                    </tr>
                    <tr>
                        <td><strong>Fecha Ingreso</strong></td>
                        <td>{{ $revision->fecha_ingreso }}</td>
                        <td><strong>Prórrogas</strong></td>
                        <td>{{ $revision->prorrogas }}</td>
                    </tr>
                    <tr>
                        <td><strong>Fecha Vencimiento</strong></td>
                        <td>{{ $revision->fecha_vencimiento }}</td>
                        <td colspan="2"></td>
                    </tr>
                </table>
                
                <form method="POST" action="{{ route('revision_desempeno.update.gh', $revision->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
            
                    <table class="table table-hover table-striped text-center mx-auto">
                        <tr>
                            <td colspan="4" style="text-align: center; background-color: rgba(94, 128, 80, 0.416);">Sección Gestión Humana</td>
                        </tr>
                        <tr>
                            <td><div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="faltas_disciplinarias">Faltas Disciplinarias</label>
                                    <div class="input-group">
                                        <input style="border: none; background-color:transparent" type="text" name="faltas_disciplinarias" class="form-control" readonly>
                                        <a id="verFaltasBtn" href="#" target="_blank" class="btn btn-info" style="display: none;">👁️ Ver</a>
                                    </div>
                                </div>
                            </div>
                            </td> 
                            
                            <td><div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="llamados_atencion_info">Llamados Atención</label>
                                    <div class="input-group">
                                        <input style="border: none; background-color:transparent" type="text" name="llamados_atencion" class="form-control" readonly>
                                        <a id="verLlamadosBtn" href="#" target="_blank" class="btn btn-info" style="display: none;">👁️ Ver</a>
                                    </div>
                                </div>
                            </div>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            

                            <td>
                                <label for="">Sanciones</label>
                                <input style="border: none; background-color:transparent" type="text" name="sanciones" class="form-control" readonly>
                                <a id="verSancionesBtn" href="#" target="_blank" class="btn btn-info btn-sm" style="display: none;">
                                   👁️ Ver Detalles
                                </a>
                            </td>
                          
                            <td><label for="">Inasistencias</label>
                                <input style="border: none; background-color:transparent" type="text" name="inasistencias" class="form-control" readonly>
                                <a id="verInasistenciasBtn" href="#" target="_blank" class="btn btn-info" style="display: none;">👁️ Ver</a>
                            </td>
                            
                            <td><label for="">suspenciones</label>
                                <input style="border: none; background-color:transparent" type="text" name="suspenciones" class="form-control" readonly>
                                <a id="verSuspencionesBtn" href="#" target="_blank" class="btn btn-info" style="display: none;">👁️ Ver</a>
                           
                            </td>
                             
                        </tr>
                        <tr>
                            <td>Cumple con Gestion Humana
                                <select name="gh_cumple" id="">
                                    <option value="si">Si Cumple</option>
                                    <option value="no">no Cumple</option>
                                </select>
                            </td>
                            <td colspan="5"><label for="">Observaciones GH</label>
                                <textarea name="observaciones_gh" rows="3" style="width: 100%">{{ $revision->observaciones_gh }}</textarea>
                            </td>
                           
                        </tr>
                        <tr>
                            <td><label for="">Diligenciado por</label></td>
                                <td>
                                    <input type="text" 
                                        name="gh_diligenciado_por" 
                                        value="{{ auth()->user()->name }}" 
                                        readonly>
                                </td>
                                <td><label for="gh_firma">Firma</label></td>
                                <td>
                                    <!-- Previsualización de la firma -->
                                    <div id="firma-container">
                                        @if($revision->gh_firma)
                                            <img src="{{ asset($revision->gh_firma) }}" id="firma-preview" 
                                                style="max-width: 150px; max-height: 80px; border: 1px solid #ddd; margin-bottom: 10px;">
                                        @else
                                            <div id="firma-preview" style="width: 150px; height: 80px; border: 1px dashed #ccc; 
                                                display: flex; align-items: center; justify-content: center; color: #999; margin-bottom: 10px;">
                                                Vista previa de la firma
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Input para cargar la firma -->
                                    <input type="file" name="gh_firma" id="gh_firma" accept="image/*" class="form-control">
                                    <small class="text-muted">Formatos aceptados: JPG, PNG (Máx. 2MB)</small>
                                    
                                    <!-- Campo oculto para mantener la firma existente -->
                                    @if($revision->gh_firma)
                                        <input type="hidden" name="gh_firma_actual" value="{{ $revision->gh_firma }}">
                                    @endif
                                </td>
                        </tr>
                        <tr>
                            <td><label for="">Fecha</label></td>
                            <td>
                                <input type="date" 
                                    name="gh_fecha" 
                                    value="{{ $revision->gh_fecha ? \Carbon\Carbon::parse($revision->gh_fecha)->format('Y-m-d') : now()->format('Y-m-d') }}">
                            </td>
                            <td><label for="">Asignar a SST</label></td>
                            <td>
                                <select name="asignado_sst" required>
                                    <option value="">Seleccione</option>
                                    @foreach($empleadosGestionHumana as $empleado)
                                        <option value="{{ $empleado->id }}" {{ $revision->asignado_sst == $empleado->id ? 'selected' : '' }}>{{ $empleado->nombre }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <div class="col-md-6">
                            <label for="fecha_vencimiento">Estado de Revision</label>
                            <input hidden type="text" name="estado" class="form-control" value="sst" readonly>
                            <p>Pendiente Serguridad y Salud en el Trabajo</p>
                        </div>
                        <tr>
                            <td colspan="4"><button type="submit">Guardar Sección GH</button></td>
                        </tr>
                    </table>
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
            




            <script>
                
            </script>


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

            <button class="btn btn-warning btn-sm" onclick="window.location='{{ url()->previous() }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                <i class="fas fa-edit"></i> Cancelar
            </button><br>
        </div>
        
        
        <script>
            const cedula = '{{ $revision->cedula }}';
        
            // Buscar faltas disciplinarias
            fetch(`/buscar-faltas/${cedula}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'found') {
                        document.querySelector('input[name="faltas_disciplinarias"]').value = data.total;
                        const btnFaltas = document.getElementById('verFaltasBtn');
                        btnFaltas.href = data.detalle_url;
                        btnFaltas.style.display = 'inline-block';
                    } else {
                        document.querySelector('input[name="faltas_disciplinarias"]').value = 0;
                        document.getElementById('verFaltasBtn').style.display = 'none';
                    }
                });
                

                

                // Buscar llamados de atención
                fetch(`/buscar-llamados/${cedula}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'found') {
                            document.querySelector('input[name="llamados_atencion"]').value = data.total;
                            const btn = document.getElementById('verLlamadosBtn');
                            btn.href = data.detalle_url;
                            btn.style.display = 'inline-block';
                        } else {
                            document.querySelector('input[name="llamados_atencion"]').value = 0;
                            document.getElementById('verLlamadosBtn').style.display = 'none';
                        }
                    });


                    



                    fetch(`/revision/inasistencias/${cedula}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'found') {
                                document.querySelector('input[name="inasistencias"]').value = data.total;
                                const btnFaltas = document.getElementById('verInasistenciasBtn');
                                btnFaltas.href = data.detalle_url;
                                btnFaltas.style.display = 'inline-block';
                            } else {
                                document.querySelector('input[name="inasistencias"]').value = 0;
                                document.getElementById('verInasistenciasBtn').style.display = 'none';
                            }
                        });




                        fetch(`/revision/sansiones/${cedula}`)
                            .then(response => {
                                if (!response.ok) {
                                    // Si la respuesta no es 2xx, lanzamos error
                                    throw new Error(`HTTP error! status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log('Respuesta:', data); // Para depuración
                                
                                if (data.status === 'error') {
                                    throw new Error(data.message);
                                }

                                const inputSanciones = document.querySelector('input[name="sanciones"]');
                                const btnFaltas = document.getElementById('verSancionesBtn');
                                
                                if (data.status === 'found') {
                                    inputSanciones.value = data.total;
                                    btnFaltas.href = data.detalle_url;
                                    btnFaltas.style.display = 'inline-block';
                                } else {
                                    inputSanciones.value = '0';
                                    btnFaltas.style.display = 'none';
                                }
                            })
                            .catch(error => {
                                console.error('Error en la petición:', error);
                                document.querySelector('input[name="sanciones"]').value = 'Error';
                                
                                // Opcional: Mostrar mensaje al usuario
                                alert('Error al cargar sanciones: ' + error.message);
                            });


                            fetch(`/revision/suspenciones/${cedula}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'found') {
                                    document.querySelector('input[name="suspenciones"]').value = data.total;
                                    const btnFaltas = document.getElementById('verSuspencionesBtn');
                                    btnFaltas.href = data.detalle_url;
                                    btnFaltas.style.display = 'inline-block';
                                } else {
                                    document.querySelector('input[name="suspenciones"]').value = 0;
                                    document.getElementById('verSuspencionesBtn').style.display = 'none';
                                }
                            });





        </script>
        
<!-- Script para previsualización -->
<script>
    document.getElementById('gh_firma').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('firma-preview');
        
        if (file) {
            if (!file.type.match('image.*')) {
                alert('Por favor selecciona una imagen válida (JPEG, PNG)');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(event) {
                if (preview.tagName === 'IMG') {
                    preview.src = event.target.result;
                } else {
                    const container = document.getElementById('firma-container');
                    container.innerHTML = '';
                    const img = document.createElement('img');
                    img.id = 'firma-preview';
                    img.src = event.target.result;
                    img.style.maxWidth = '150px';
                    img.style.maxHeight = '80px';
                    img.style.border = '1px solid #ddd';
                    img.style.marginBottom = '10px';
                    container.appendChild(img);
                }
            };
            reader.readAsDataURL(file);
        }
    });
    </script>
</div>

<x-footer />

</x-app-layout>

