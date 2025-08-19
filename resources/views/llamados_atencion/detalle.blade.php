<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px">
            <div class="contenido">    

                
                    <h2 class="titulo_formulario">Detalle de  Nuevo Llamado / Recordatorio al Empleado</h2><br>
                        @csrf
                        @method('PATCH')
                    
                    <div class="table-responsive">
    <table class="table table-hover table-striped text-center align-middle w-100 mx-auto" style="table-layout: fixed;">
        <thead>
            <tr class="table-success">
                <th colspan="5">Información Básica del Empleado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Código</strong></td>
                <td colspan="2"><strong>Número Documento</strong></td>
                <td colspan="2"><strong>Nombre Empleado</strong></td>
            </tr>
            <tr>
                <td>{{ $proceso->codigo }}</td>
                <td colspan="2">{{ $proceso->documento }}</td>
                <td colspan="2">{{ $proceso->trabajador }}</td>
            </tr>
            <tr>
                <td colspan="5" class="table-success"><strong>Información Fechas del Reporte</strong></td>
            </tr>
            <tr>
                <td colspan="2"><strong>Fecha Reporte</strong></td>
                <td colspan="3"><strong>Fecha Falta</strong></td>
            </tr>
            <tr>
                <td colspan="2">{{ $proceso->fecha_notificacion }}</td>
                <td colspan="3">{{ $proceso->fecha_falta }}</td>
            </tr>
            <tr>
                <td colspan="5" class="table-success"><strong>Información de la Falta</strong></td>
            </tr>
            <tr>
                <td colspan="2"><strong>Asunto</strong></td>
                <td colspan="3"><strong>Clase Falta</strong></td>
            </tr>
            <tr>
                <td colspan="2">{{ $proceso->asunto }}</td>
                <td colspan="3">{{ $proceso->clase_falta }}</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Descripción de la Falta</strong></td>
                <td colspan="2"><strong>Observación</strong></td>
            </tr>
            <tr>
                <td colspan="3" style="word-wrap: break-word;">{{ $proceso->descripcion_falta }}</td>
                <td colspan="2" style="word-wrap: break-word;">{{ $proceso->observaciones }}</td>
            </tr>
            <tr>
                <td colspan="5" class="table-success"><strong>Zona de Autenticación de Quien Notifica</strong></td>
            </tr>
            <tr>
                <td><strong># Documento</strong></td>
                <td colspan="2"><strong>Nombre</strong></td>
                <td colspan="2"><strong>Cargo</strong></td>
            </tr>
            <tr>
                <td>{{ $proceso->documento_notificacion }}</td>
                <td colspan="2">{{ $proceso->nombre_notificacion }}</td>
                <td colspan="2">{{ $proceso->cargo }}</td>
            </tr>
            @if($proceso->pdf_evidencia)
            <tr>
                <td colspan="5">
                    <strong>Evidencia:</strong>
                    <a href="{{ asset($proceso->pdf_evidencia) }}" target="_blank">Ver PDF</a>
                </td>
            </tr>
            @endif
        </tbody>
    </table>

                    </div>
                            
                            <script>

                        document.addEventListener("DOMContentLoaded", function () {
                            const firmaPreview = document.getElementById('firma_preview');

                            if (!firmaPreview.src || firmaPreview.src === window.location.href) {
                                firmaPreview.style.display = 'none';
                            }
                        });
                            document.getElementById('firma_input').addEventListener('change', function(event) {
                                const input = event.target;
                                const preview = document.getElementById('firma_preview');
                                const textarea = document.getElementById('firma_textarea');
                                const quitarFirmaBtn = document.getElementById('quitar_firma');
                            
                                if (input.files && input.files.length > 0) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        preview.src = e.target.result;
                                        preview.style.display = 'block'; // Mostrar imagen
                                        textarea.style.display = 'none'; // Ocultar textarea
                                        textarea.value = ''; // Limpiar contenido del textarea
                                        quitarFirmaBtn.style.display = 'block'; // Mostrar botón de quitar firma
                                    };
                                    reader.readAsDataURL(input.files[0]);
                                } else {
                                    resetFirma();
                                }
                            });
                            
                            function resetFirma() {
                                document.getElementById('firma_preview').style.display = 'none';
                                document.getElementById('firma_preview').src = '';
                                document.getElementById('firma_textarea').style.display = 'block';
                                document.getElementById('firma_input').value = ''; // Limpiar input file
                                document.getElementById('quitar_firma').style.display = 'none'; // Ocultar botón
                            }
              
                
                
            
                            function previewFirma(event) {
                                var output = document.getElementById('firma_preview');
                                output.src = URL.createObjectURL(event.target.files[0]);
                                output.style.display = 'block';
                            }
                        </script>
            

        </div>
        <br><br>
        <a href="{{ route('llamado.imprimir', $proceso->id) }}"
            class="btn btn-outline-dark btn-sm" 
           style="color: teal" 
            target="_blank" 
            style="margin: 10px 0;">
            <i class="fas fa-file-pdf"></i>🖨️ Imprimir en PDF
            </a>
        <button class="btn btn-warning btn-sm" onclick="window.location='{{ url()->previous() }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
            <i class="fas fa-edit"></i> Cancelar
        </button><br>
        </div>
        
</div>

<x-footer />

</x-app-layout>

