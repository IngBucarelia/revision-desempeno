<x-app-layout>
    <x-appbar />


 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />


<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px">
            <div class="contenido">    
                <h2 class="titulo_formulario">Registrar Falta Disciplinaria</h2><br> 

                <form method="POST" action="{{ route('faltas_disciplinarias.store') }}" enctype="multipart/form-data">
                    @csrf
                
                <table class="table table-hover table-striped text-center mx-auto">
                    <tr>
                        <td colspan="5" style="text-align: center; background-color: rgba(94, 128, 80, 0.416);">Información Básica del Empleado </td>
                    </tr>
                        <tr>
                            <td><label for="">#Contrato</label></td>
                            <td><label for="">Numero Documento</label></td>
                            <td><label for="">Nombre Empleado</label></td>
                            <td><label for="">Labor</label></td>                        
                        </tr>
                        <tr>
                            <td> <input readonly type="number" name="codigo" placeholder="Número Contrato" required></td>
                            <td><input type="number" name="numero_documento_trabajador" placeholder="Documento " required></td>
                            <td><input readonly type="text" name="nombre_trabajador" placeholder="Nombre Trabajador" required></td> 
                            <td><input readonly type="text" name="labor" placeholder="Labor" required></td>            
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color: rgba(94, 128, 80, 0.416);">Información Fechas y Horas del Reporte </td>
                        </tr>
                        <tr>
                            <td><label for="">Fecha Reporte</label></td>
                            <td><label for="">Hora Reporte</label></td>
                            <td><label for="">Fecha Falta</label></td> 
                            <td><label for="">Hora Falta</label></td>           
                        </tr>
                        <tr>
                            <td><input type="date" name="fecha_reporte" placeholder="Fecha Reporte" required></td>
                            <td> <input type="time" name="hora_reporte" placeholder="Hora Reporte"></td>
                            <td> <input type="date" name="fecha_falta" placeholder="Fecha Falta" required></td>  
                            <td><input type="time" name="hora_falta" placeholder="Hora Falta"></td>          
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);">Información  de la Falta </td>
                        </tr>
                        <tr>
                            <td colspan="2"><label for="">Tipo Falta</label></td>
                            <td colspan="2"><label for="">Clase Falta</label></td>                     
                        </tr>
                        <tr><td colspan="2">
                        <div class="mb-3">
                            <div class="d-flex align-items-center">
                                <select name="tipo_falta" id="tipo_falta" class="form-control me-2" required>
                                    <option value="">Seleccione un tipo</option>
                                    @foreach(\App\Models\TipoFalta::all() as $tipo)
                                        <option value="{{ $tipo->nombre }}">{{ $tipo->nombre }}</option>
                                    @endforeach
                                </select>
                                <a href="{{ route('tipo_faltas.create') }}" class="btn btn-success" title="Nuevo tipo" target="_blank">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </td>                             
                           
                                <td colspan="3">
                                    
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center">
                                                <select name="clase_falta" id="select-clase-falta" class="form-control me-2" required style="width: 100%;">
                                                    <option value="">Seleccione una clase</option>
                                                    @foreach($clasesFalta as $clase)
                                                        <option value="{{ $clase->nombre }}">{{ $clase->nombre }}</option>
                                                    @endforeach
                                                </select>

                                                <a href="{{ route('clases_faltas.create') }}" 
                                                class="btn btn-success" 
                                                style="white-space: nowrap;" 
                                                title="Agregar nueva clase" target="_blank">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>


                                     
                                </td>           
                            
                                                                
                        </tr>
                        <tr>
                            <td colspan="4"><label for="">Descripció de la Falta</label></td>
                        </tr>
                        <tr>
                            <td colspan="4"><textarea class="textarea-estilizado" name="descripcion_falta" placeholder="Descripción Falta" required></textarea><td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);">Información  de Testigo </td>
                        </tr>
                        <tr>
                           
                            <td colspan="2"><label for="">Nombre Testigo</label></td>
                            <td colspan="2"><label for="">Cargo Testigo</label></td>            
                        </tr>
                        <tr>
                            <td colspan="2"> <input type="text" name="nombre_testigo" placeholder=" Ingrese Nombre Testigo"></td>
                            <td colspan="2"><input  type="text" name="cargo_testigo" placeholder="Ingrese Cargo Testigo"></td>            
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);;"> Adicionales </td>
                        </tr>
                        <tr>
                            
                            <td colspan="2"><label for="">Evidencias Adicionales</label></td>
                            <td colspan="2"><label for="">Comentarios Adicionales</label></td>            
                        </tr>
                        <tr>
                            
                            <td colspan="2"><textarea class="textarea-estilizado" name="evidencias_adicionales" placeholder=" Ingrese Evidencias Adicionales"></textarea></td>
                            <td colspan="2"><textarea class="textarea-estilizado" name="comentarios_adicionales" placeholder="Ingrese Comentarios Adicionales"></textarea></td>            
                        </tr>
                       <!-- <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);;">Zona de Gestion Humana</td>
                        </tr>
                        <tr>
                            <td colspan="4"><label for="">Comentarios Gestión Humana</label></td>
                                      
                        </tr>
                        <tr>
                            <td colspan="4"><textarea class="textarea-estilizado" name="comentarios_gestion_humana" placeholder="Ingrese Comentarios Gestión Humana"></textarea></td>
                                     
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);;">Tipo de Accion a Tomar</td>
                        </tr>
                        <tr>
                            <td colspan="1"><label><input type="hidden" name="compromiso" value="0">
                                <input type="checkbox" name="compromiso" value="1"> Compromiso</label></td>
                            <td colspan="2"><label><input type="hidden" name="descargo" value="0">
                                <input type="checkbox" name="descargo" value="1"> Descargo</label></td>
                            <td colspan="1"><label><input type="hidden" name="llamado_atencion" value="0">
                                <input type="checkbox" name="llamado_atencion" value="1">Llamado de Atención</label></td>
                            <tr>
                                <td colspan="2"><label><input type="hidden" name="sancion" value="0">
                                    <input type="checkbox" name="sancion" value="1"> Sanción</label></td> 
                                <td colspan="3"><label><input type="hidden" name="terminacion_contrato" value="0">
                                    <input type="checkbox" name="terminacion_contrato" value="1"> Terminación de Contrato</label></td></tr>           
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);;"> Evidencia en PDF </td>
                        </tr> -->
                        <tr>
                            <td colspan="2"><label for="pdf_evidencia" >Adjuntar Evidencia (PDF)</label></td>
                            <td colspan="2">    <input type="file" name="pdf_evidencia" accept="application/pdf">                             ></td>
                        </tr>
                      
                    </table>
                    <button  type="submit">💾 Agregar Falta Disciplinaria</button>
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

            <button class="btn btn-warning btn-sm" onclick="window.location='{{ url()->previous() }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                </i>❌ Cancelar
            </button><br>
        </div>
        <script>
            document.querySelector('input[name="numero_documento_trabajador"]').addEventListener('change', function () {
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

