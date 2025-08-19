<x-app-layout>
    <x-appbar />

<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
<link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">
 <div class="contenedor-principal">
     <x-sidebar />
     <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px"> 
        <div class="card-header">
            <h2>Acta de Descargos</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('faltas_disciplinarias.guardar_descargos', $proceso->id) }}" method="POST">
                @csrf
                
                <!-- Encabezado estático -->
                <div class="mb-4">
                    <p>En Puerto Wilches, a los {{ now()->format('d') }} días del mes de {{ now()->format('F') }} de {{ now()->format('Y') }} siendo las {{ now()->format('h:i A') }} en la Sala de Gestión Humana donde funcionan las dependencias de la empresa PALMAS OLEAGINOSAS BUCARELIA S.A.S., se reúnen: por el Sindicato acompaña la diligencia el señor ANGEL MIGUEL CONDE TAPIAY RAFAEL ERNESTO OLIVEROS DAVILA por la empresa la señora NANCY ELENA ROMERO NARVAEZ, Directora de Gestión Humana</p>
                </div>
                
                <!-- Sección dinámica 1 -->
                <div class="mb-4">
                    <p>El objeto fundamental de la presente diligencia, es el de escuchar en descargos al señor <strong>{{ $proceso->nombre_trabajador }}</strong> identificado con cédula de ciudadanía número <strong>{{ $proceso->numero_documento_trabajador }}</strong>, respecto a los hechos relacionados con el presunto incumplimiento de obligaciones especiales del trabajador y violación de prohibiciones.</p>
                </div>
                
                <!-- Secciones estáticas -->
                <div class="mb-4">
                    <p>Hechos que constituyen un presunto incumplimiento a los deberes y obligaciones que tiene como trabajador, los cuales se encuentran estipulados en el reglamento de PALMAS OLEAGINOSAS BUCARELIA S.A.S., el perfil del cargo, su contrato laboral. Hechos que se describieron en la citación a la Diligencia de Descargos, de la cual fue notificado al colaborador el 1 de Julio de 2025, cumpliendo así con el tiempo que, según el procedimiento debe transcurrir entre la notificación y la Audiencia.</p>
                    
                    <p>Se le ofreció al trabajador citado la opción de estar acompañado en esta diligencia por un compañero de trabajo, para que actúe como testigo de la misma condición, expresa que viene acompañado de los representantes de la organización sindical.</p>
                </div>
                
                <!-- Sección dinámica 2 -->
                <div class="mb-4">
                    <p>El trabajador citado a descargos refiere sus generales de ley así, Nombre: <strong>{{ $proceso->nombre_trabajador }}</strong>, mayor de edad, identificado con la cédula de ciudadanía número <strong>{{ $proceso->numero_documento_trabajador }}</strong> residente 
                    <input type="text" name="direccion" class="form-control" placeholder="Dirección del trabajador" required>
                    , celular 
                    <input type="text" name="telefono" class="form-control" placeholder="Número de celular" required>
                    , funciones que desempeña actualmente son las relacionadas al cargo de Operario de campo.</p>
                    <input type="text" name="labor" class="form-control" placeholder="labor desempeñada" required>
                </div>

                 
                
                <!-- Más secciones estáticas -->
                <div class="mb-4">
                    <p>Como secretaria actúa Nancy Elena Romero Narvaez, quien enterada manifiesta su aceptación.</p>
                    <p>Se exhorta al citado, para que dé respuesta en forma concreta y clara a cada uno de los interrogantes que se le efectuarán en el curso de la Diligencia de Descargos y se le solicita hablar en forma pausada para que sus respuestas y comentarios sean consignados en el Acta de la Diligencia fielmente.</p>
                </div>
                
                <!-- Preguntas -->
                <div class="mb-4">
                    @for($i = 1; $i <= 19; $i++)
                        <div class="mb-3">
                            <label class="form-label">{{ $i }}. {{ $preguntas[$i] }}</label>
                            <textarea name="respuesta_{{ $i }}" class="form-control" rows="2" required></textarea>
                        </div>
                    @endfor
                </div>

                <div class="row text-center mt-2">
                    
                    <textarea name="comentarios" id="" cols="30" rows="10"></textarea>
                </div>
                
                <!-- Firmas -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Persona implicada:</label>
                        <input type="text" name="firma_implicado" class="form-control" required><br><br>
                        <div class="signature-line"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Responsable:</label>
                        <input type="text" name="firma_responsable" class="form-control" required><br><br>
                        <div class="signature-line"></div>
                    </div>
                </div>
                
                <!-- Espacio para firmas -->
                <div class="row text-center mt-2">
                    
                    <div class="col-md-5">
                        <p>NANCY ELENA ROMERO NARVAEZ<br>Directora de Gestión Humana</p><br><br>
                        <div class="signature-line"></div>
                    </div>
                    <div class="col-md-5">
                        <p>RAFAEL E. OLIVEROS DAVILA<br>Representante Sintrainagro</p><br>
                        <br>
                        <div class="signature-line"></div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary mt-4">Guardar Acta de Descargos</button>
            </form>
            <a href="{{ route('faltas_disciplinarias.descargos', $proceso->id) }}" 
            class="btn btn-danger" >
                <i class="fas fa-file-pdf"></i> Continuar 
        </div>
    </div>
</div>
<div class="modal fade" id="descargosPdfModal" tabindex="-1" aria-labelledby="descargosPdfModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="descargosPdfModalLabel">Descargos Registrados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Descargos registrados correctamente. ¿Deseas imprimir el acta en PDF?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, gracias</button>
                <a href="#" id="imprimirPdfBtn" class="btn btn-primary" target="_blank">Sí, imprimir</a>
            </div>
        </div>
    </div>
</div>
<style>
    .signature-line {
        border-top: 1px solid #000;
        height: 1px;
        margin: 20px auto;
        width: 80%;
    }
</style>
<script>
    @if(session('show_descargos_modal'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const descargoId = "{{ session('show_descargos_modal') }}";
            const imprimirBtn = document.getElementById('imprimirPdfBtn');
            
            // Actualiza la URL del botón para imprimir
            imprimirBtn.href = `/faltas-disciplinarias/generar-pdf-descargos/${descargoId}`;
            
            // Muestra el modal
            const myModal = new bootstrap.Modal(document.getElementById('descargosPdfModal'));
            myModal.show();
        });
    </script>
@endif
</script>
<x-footer />

</x-app-layout>