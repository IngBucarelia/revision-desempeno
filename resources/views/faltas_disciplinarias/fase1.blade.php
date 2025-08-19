<x-app-layout>
    <x-appbar />
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px"> 
            <div class="contenido">    
                <h2 class="titulo_formulario">Terminar Registro Falta Disciplinaria</h2><br>  
                <form action="{{ route('faltas_disciplinarias.fase1', ['faltas_disciplinaria' => $falta->id]) }}" method="POST">
                    @csrf
                                
                                
                                
                                
                                
                    @method('PUT')
                                
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
                            <td> <input  type="number" readonly value="{{$falta->codigo}}" name="codigo" placeholder="Número Contrato" required></td>
                            <td><input type="number" readonly value="{{$falta->numero_documento_trabajador}}" name="numero_documento_trabajador" placeholder="Documento " required></td>
                            <td><input type="text" readonly value="{{$falta->nombre_trabajador}}" name="nombre_trabajador" placeholder="Nombre Trabajador" required></td> 
                            <td><input type="text" readonly value="{{$falta->labor}}" name="labor" placeholder="Labor" required></td>            
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
                            <td><input type="date" readonly value="{{$falta->fecha_reporte}}" name="fecha_reporte" placeholder="Fecha Reporte" required></td>
                            <td> <input type="time" readonly value="{{$falta->hora_reporte}}" name="hora_reporte" placeholder="Hora Reporte"></td>
                            <td> <input type="date" readonly value="{{$falta->fecha_falta}}" name="fecha_falta" placeholder="Fecha Falta" required></td>  
                            <td><input type="time" readonly value="{{$falta->hora_falta}}" name="hora_falta" placeholder="Hora Falta"></td>          
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
                                                <input type="text" readonly value="{{$falta->tipo_falta}}">
                                            </div>
                                        </div>
                    </td>                             
                           
                                <td colspan="3">
                                    
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center">
                                                <input type="text" readonly value="{{$falta->clase_falta}}">
                                            </div>
                                        </div>


                                     
                                </td>           
                            
                                                                
                        </tr>
                        <tr>
                            <td colspan="4"><label for="">Descripció de la Falta</label></td>
                        </tr>
                        <tr>
                            <td colspan="4"><textarea readonly style="width: 600px;height:200px" class="textarea-estilizado" name="descripcion_falta" placeholder="Descripción Falta" required>{{$falta->descripcion_falta}}</textarea><td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);">Información  de Testigo </td>
                        </tr>
                        <tr>
                           
                            <td colspan="2"><label for="">Nombre Testigo</label></td>
                            <td colspan="2"><label for="">Cargo Testigo</label></td>            
                        </tr>
                        <tr>
                            <td colspan="2"> <input readonly value="{{$falta->nombre_testigo}}" type="text" name="nombre_testigo" placeholder=" Ingrese Nombre Testigo"></td>
                            <td colspan="2"><input readonly value="{{$falta->cargo_testigo}}" type="text" name="cargo_testigo" placeholder="Ingrese Cargo Testigo"></td>            
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);;"> Adicionales </td>
                        </tr>
                        <tr>
                            
                            <td colspan="2"><label for="">Evidencias Adicionales</label></td>
                            <td colspan="2"><label for="">Comentarios Adicionales</label></td>            
                        </tr>
                        <tr>
                            
                            <td colspan="2"><textarea readonly style="width: 400px;height:200px" class="textarea-estilizado" name="evidencias_adicionales" placeholder=" Ingrese Evidencias Adicionales">{{$falta->evidencias_adicionales}}</textarea></td>
                            <td colspan="2"><textarea readonly style="width: 400px;height:200px"  class="textarea-estilizado" name="comentarios_adicionales" placeholder="Ingrese Comentarios Adicionales">{{$falta->comentarios_adicionales}}</textarea></td>            
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);;">Zona de Gestion Humana</td>
                        </tr>
                        
                        
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);;"> Evidencia en PDF </td>
                        </tr> 
                       <tr>
                        <td colspan="2"><strong>Evidencia (PDF)</strong></td>
                        <td colspan="2">
                            @if($falta->pdf_evidencia)
                                <a href="{{ asset($falta->pdf_evidencia) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    Ver Evidencia PDF
                                </a>
                            @else
                                <span class="text-muted">No se ha cargado evidencia</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                            <td colspan="4"><label for="">Comentarios Gestión Humana</label></td>
                                      
                        </tr>
                        <tr>
                            <td colspan="4"><textarea style="width: 400px;height:200px" class="textarea-estilizado" name="comentarios_gestion_humana" placeholder="Ingrese Comentarios Gestión Humana"></textarea></td>
                                     
                        </tr>
                    <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);;">Tipo de Accion a Tomar</td>
                        </tr>
                        <tr>
                             <tr>
                                <td colspan="5">
                                    <select name="estado" id="estado-select">
                                        <option value="" disabled selected>Seleccionar</option> 
                                        <option value="2">Citar a Descargos</option>
                                        <option value="3">Tomar Decision </option>
                                        <option value="4">Terminar Proceso</option>
                                    </select>
                                </td>
                             </tr>
                        <tr>

                            <tr id="fila-fecha-citacion" style="display: none;">
                                <td colspan="5">
                                    <label for="fecha_citacion">Fecha de Citación a Descargos</label>
                                    <input type="date" name="fecha_citacion" id="fecha-citacion-input"><br><br>
                                    <label for="hora_citacion">Hora de Citación a Descargos</label>
                                    <input type="time" name="hora_citacion" id="hora-citacion-input"> </td>
                            </tr>

                        <script>
                            const estadoSelect = document.getElementById('estado-select');
                            const filaFechaCitacion = document.getElementById('fila-fecha-citacion');
                            
                            estadoSelect.addEventListener('change', (event) => {
                                if (event.target.value === '2') {
                                    filaFechaCitacion.style.display = ''; // Muestra la fila
                                } else {
                                    filaFechaCitacion.style.display = 'none'; // Oculta la fila
                                }
                            });
                        </script>

                      
                    </table>
                    <button  type="submit">Gestionar Falta Disciplinaria</button>
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

