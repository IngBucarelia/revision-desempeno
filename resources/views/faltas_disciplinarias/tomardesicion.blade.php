<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px"> 
            <div class="contenido">    

                <h2 class="titulo_formulario">Terminar Registro Falta Disciplinaria</h2><br>  
                <form action="{{ route('faltas_disciplinarias.updateFin', ['faltas_disciplinaria' => $proceso->id]) }}" method="POST">
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
                            <td colspan="2"><label><input type="hidden" name="compromiso" value="0">
                                <input type="checkbox" name="compromiso" value="1"> Compromiso</label></td>
                           
                            <td colspan="2"><label><input type="hidden" name="llamado_atencion" value="0">
                                <input type="checkbox" name="llamado_atencion" value="1">Llamado de Atención</label></td>
                            <tr>
                                <td colspan="2"><label><input type="hidden" name="sancion" value="0">
                                    <input type="checkbox" name="sancion" value="1"> Sanción</label></td> 
                                
                                <td colspan="2"><label><input type="hidden" name="suspencion" value="0">
                                    <input type="checkbox" name="suspencion" value="1"> Suspencion </label></td> 
                                </tr>    
                                
                                <tr>
                                    <td colspan="4"><label><input type="hidden" name="terminacion_contrato" value="0">
                                    <input type="checkbox" name="terminacion_contrato" value="1"> Terminación de Contrato</label></td>
                                </tr>
                        </tr>
                        
                       

                      
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

