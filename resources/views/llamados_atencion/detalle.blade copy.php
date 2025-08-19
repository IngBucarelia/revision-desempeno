<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal"> 
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px">
            <div class="contenido">    
                <h2 class="titulo_formulario">Detalle Llamado de Atención  y/o Recordatorio </h2><br> 

                <table class="table table-hover table-striped text-center mx-auto">
                    <tr>
                        <td colspan="5" style="text-align: center; background-color: rgba(94, 128, 80, 0.416);">Información Básica del Empleado </td>
                    </tr>
                        <tr>
                            <td><label for="">Código</label></td>
                            <td><label for="">Numero Documento</label></td>
                            <td><label for="">Nombre Empleado</label></td>
                            <td><label for="">Labor</label></td>                        
                        </tr>
                        <tr>
                            <td>{{ $proceso->codigo }}</td>
                            <td>{{ $proceso->numero_documento_trabajador}}</td>
                            <td>{{ $proceso->nombre_trabajador}}</td> 
                            <td>{{ $proceso->labor}}  
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
                            <td>{{ $proceso->fecha_reporte}} </td>
                            <td> {{ $proceso->hora_reporte}} </td>
                            <td> {{ $proceso->fecha_falta}} </td>  
                            <td>{{ $proceso->hora_falta}} </td>          
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);">Información  de la Falta </td>
                        </tr>
                        <tr>
                            
                            <td colspan="2"><label for="">Clase Falta</label></td>
                            <td colspan="2"><label for="">Cantidad</label></td>
                            
                            
                            
                        </tr>
                        <tr>                           
                            <td colspan="2"> {{ $proceso->clase_falta}}</td>
                            <td colspan="2">{{ $proceso->cantidad }}</td>                                      
                        </tr>
                        <tr>
                            <td colspan="4"><label for="">Descripció de la Falta</label></td>
                        </tr>
                        <tr>
                            <td colspan="4">{{ $proceso->descripcion_falta}}></textarea><td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);">Información  de Testigo </td>
                        </tr>
                        <tr>
                           
                            <td colspan="2"><label for="">Nombre Testigo</label></td>
                            <td colspan="2"><label for="">Cargo Testigo</label></td>            
                        </tr>
                        <tr>
                            <td colspan="2"> {{ $proceso->nombre_testigo}}</td>
                            <td colspan="2">{{ $proceso->cargo_testigo}}</td>            
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);;"> Adicionales </td>
                        </tr>
                        <tr>
                            
                            <td colspan="2"><label for="">Evidencias Adicionales</label></td>
                            <td colspan="2"><label for="">Comentarios Adicionales</label></td>            
                        </tr>
                        <tr>
                            
                            <td colspan="2">{{ $proceso->evidencias_adicionales}}</td>
                            <td colspan="2">{{ $proceso->comentarios_adicionales}}</td>            
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);;">Zona de Gestion Humana</td>
                        </tr>
                        <tr>
                            <td colspan="4"><label for="">Comentarios Gestión Humana</label></td>
                                      
                        </tr>
                        <tr>
                            <td colspan="4">{{ $proceso->comentarios_gestion_humana}}</td>
                                     
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);;">Tipo de Accion a Tomar</td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    <input type="hidden" name="descargo" value="0">
                                    <input type="checkbox" name="descargo" value="1" {{ $proceso->descargo == 1 ? 'checked' : '' }} disabled> Descargo
                                </label>
                            </td>
                            <td>
                                <label>
                                    <input type="hidden" name="llamado_atencion" value="0">
                                    <input type="checkbox" name="llamado_atencion" value="1" {{ $proceso->llamado_atencion == 1 ? 'checked' : '' }} disabled> Llamado de Atención
                                </label>
                            </td>
                            <td>
                                <label>
                                    <input type="hidden" name="sancion" value="0">
                                    <input type="checkbox" name="sancion" value="1" {{ $proceso->sancion == 1 ? 'checked' : '' }} disabled> Sanción
                                </label>
                            </td>
                            <td>
                                <label>
                                    <input type="hidden" name="terminacion_contrato" value="0">
                                    <input type="checkbox" name="terminacion_contrato" value="1" {{ $proceso->terminacion_contrato == 1 ? 'checked' : '' }} disabled> Terminación de Contrato
                                </label>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                @if($proceso->pdf_evidencia)
                                    <p><strong>Evidencia:</strong> <a href="{{ asset($proceso->pdf_evidencia) }}" target="_blank">Ver PDF</a></p>
                                @endif
                            </td>
                        </tr>
                        
                      
                    </table>
                       
        


            

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

