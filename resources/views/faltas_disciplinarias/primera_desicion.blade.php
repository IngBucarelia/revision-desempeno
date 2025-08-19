<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px"> 
            <div class="contenido">    

                <h2 class="titulo_formulario"> Registro de Apelación de Falta Disciplinaria</h2><br>  
                <form action="{{ route('faltas_disciplinarias.apelar', ['faltas_disciplinaria' => $proceso->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                
                <table class="table table-hover table-striped text-center mx-auto">
                <input type="hidden" value="3" name="estado">    
                
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
                            <td> <input  type="number" readonly value="{{$proceso->codigo}}" name="codigo" placeholder="Número Contrato" required></td>
                            <td><input type="number" readonly value="{{$proceso->numero_documento_trabajador}}" name="numero_documento_trabajador" placeholder="Documento " required></td>
                            <td><input type="text" readonly value="{{$proceso->nombre_trabajador}}" name="nombre_trabajador" placeholder="Nombre Trabajador" required></td> 
                            <td><input type="text" readonly value="{{$proceso->labor}}" name="labor" placeholder="Labor" required></td>            
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
                            <td><input type="date" readonly value="{{$proceso->fecha_reporte}}" name="fecha_reporte" placeholder="Fecha Reporte" required></td>
                            <td> <input type="time" readonly value="{{$proceso->hora_reporte}}" name="hora_reporte" placeholder="Hora Reporte"></td>
                            <td> <input type="date" readonly value="{{$proceso->fecha_falta}}" name="fecha_falta" placeholder="Fecha Falta" required></td>  
                            <td><input type="time" readonly value="{{$proceso->hora_falta}}" name="hora_falta" placeholder="Hora Falta"></td>          
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
                                                <input type="text" readonly value="{{$proceso->tipo_falta}}">
                                            </div>
                                        </div>
                    </td>                             
                           
                                <td colspan="3">
                                    
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center">
                                                <input type="text" readonly value="{{$proceso->clase_falta}}">
                                            </div>
                                        </div>


                                     
                                </td>           
                            
                                                                
                        </tr>
                        <tr>
                            <td colspan="4"><label for="">Descripció de la Falta</label></td>
                        </tr>
                        <tr>
                            <td colspan="4"><textarea readonly style="width: 600px;height:200px" class="textarea-estilizado" name="descripcion_falta" placeholder="Descripción Falta" required>{{$proceso->descripcion_falta}}</textarea><td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);">Información  de Testigo </td>
                        </tr>
                        <tr>
                           
                            <td colspan="2"><label for="">Nombre Testigo</label></td>
                            <td colspan="2"><label for="">Cargo Testigo</label></td>            
                        </tr>
                        <tr>
                            <td colspan="2"> <input readonly value="{{$proceso->nombre_testigo}}" type="text" name="nombre_testigo" placeholder=" Ingrese Nombre Testigo"></td>
                            <td colspan="2"><input readonly value="{{$proceso->cargo_testigo}}" type="text" name="cargo_testigo" placeholder="Ingrese Cargo Testigo"></td>            
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);;"> Adicionales </td>
                        </tr>
                        <tr>
                            
                            <td colspan="2"><label for="">Evidencias Adicionales</label></td>
                            <td colspan="2"><label for="">Comentarios Adicionales</label></td>            
                        </tr>
                        <tr>
                            
                            <td colspan="2"><textarea readonly style="width: 400px;height:200px" class="textarea-estilizado" name="evidencias_adicionales" placeholder=" Ingrese Evidencias Adicionales">{{$proceso->evidencias_adicionales}}</textarea></td>
                            <td colspan="2"><textarea readonly style="width: 400px;height:200px"  class="textarea-estilizado" name="comentarios_adicionales" placeholder="Ingrese Comentarios Adicionales">{{$proceso->comentarios_adicionales}}</textarea></td>            
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);;">Zona de Gestion Humana</td>
                        </tr>
                        <tr>
                            <td colspan="4"><label for="">Comentarios Gestión Humana</label></td>
                                      
                        </tr>
                        <tr>
                            <td colspan="4"><textarea style="width: 400px;height:200px" class="textarea-estilizado" name="comentarios_gestion_humana" placeholder="Ingrese Comentarios Gestión Humana">{{$proceso->comentarios_gestion_humana}}</textarea></td>
                                     
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);;"> Evidencia en PDF </td>
                        </tr> 
                        <tr>
                        <td colspan="2"><strong>Evidencia (PDF)</strong></td>
                        <td colspan="2">
                            @if($proceso->pdf_evidencia)
                                <a href="{{ asset($proceso->pdf_evidencia) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    Ver Evidencia PDF
                                </a>
                            @else
                                <span class="text-muted">No se ha cargado evidencia</span>
                            @endif
                        </td>
                    </tr>
                     
                        
                        <tr>
                            <td colspan="5" style="text-align: center; background-color: rgba(94, 128, 80, 0.416);"> Información de Descargos </td>
                        </tr> 
                        <tr>
                            <td colspan="2">
                                Observaciones de Descargo Presentado
                            </td>
                            <td colspan="3">
                                Evidencias de Descargo
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label>
                                <textarea style="width: 530px;height:155px;" name="comentarios_descargos" id="" readonly>{{$proceso->comentarios_descargos}}</textarea>
                            </td>
                            
                            <td colspan="3"> 
                                @if($proceso->descargoDetalles)
                                    <a href="{{ route('faltas_disciplinarias.ver_descargos', ['id' => $proceso->id]) }}" class="btn btn-outline-info btn-sm">
                                        Ver Detalles del Descargo
                                    </a>
                                @else
                                    <span class="text-muted">No se ha cargado un descargo</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);;">Tipo de Accion a Tomar</td>
                        </tr>
                        <tr>
                            @if($proceso->llamado_atencion == 1)
                                <td>
                                    <label>
                                        <input type="text" name="compromiso_llamado_atencion" value="Llamado de atención">
                                    </label>
                                </td>
                            @endif

                            @if($proceso->sancion == 1)
                                <td>
                                    <label>
                                        <input type="text" name="compromiso_sancion" value="Sanción">
                                    </label>
                                </td>
                            @endif
                            
                            @if($proceso->suspencion == 1)
                                <td>
                                    <label>
                                        <input type="text" name="compromiso_suspencion" value="Suspensión">
                                    </label>
                                </td>
                            @endif

                            @if($proceso->terminacion_contrato == 1)
                                <td>
                                    <label>
                                        <input type="text" name="compromiso_terminacion" value="Terminación de contrato">
                                    </label>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="d-flex align-items-center mb-3">
                                    <label class="me-3">¿Desea apelar?</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="apelo" id="apelacionSi" value="1">
                                        <label class="form-check-label" for="apelacionSi">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="apelo" id="apelacionNo" value="0" checked>
                                        <label class="form-check-label" for="apelacionNo">No</label>
                                    </div>
                                </div>
                                
                                <div id="camposApelacion" style="display: none;">
                                    <div class="mb-3">
                                        <label for="comentarioApelacion" class="form-label">Área de Comentarios de Apelación:</label>
                                        <textarea class="form-control" id="comentarioApelacion" name="comentario_apelacion" rows="3"></textarea>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const apelacionSi = document.getElementById('apelacionSi');
                                const apelacionNo = document.getElementById('apelacionNo');
                                const camposApelacion = document.getElementById('camposApelacion');
                                
                                function toggleComentarios() {
                                    if (apelacionSi.checked) {
                                        camposApelacion.style.display = 'block';
                                    } else {
                                        camposApelacion.style.display = 'none';
                                    }
                                }

                                apelacionSi.addEventListener('change', toggleComentarios);
                                apelacionNo.addEventListener('change', toggleComentarios);

                                // Ocultar al inicio, a menos que ya esté seleccionado "Sí" por alguna razón.
                                toggleComentarios(); 
                            });
                        </script>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const checkApelacion = document.getElementById('checkApelacion');
                                const camposApelacion = document.getElementById('camposApelacion');
                                
                                checkApelacion.addEventListener('change', function() {
                                    if (this.checked) {
                                        camposApelacion.style.display = 'block';
                                    } else {
                                        camposApelacion.style.display = 'none';
                                    }
                                });
                            });
                        </script>
                       

                      
                    </table>
                    <button  type="submit">Tomar Desición sobre Falta Disciplinaria</button>
                    </form>

            <button class="btn btn-warning btn-sm" onclick="window.location='{{ url()->previous() }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                <i class="fas fa-edit"></i> Cancelar
            </button><br>
        </div></div>
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

