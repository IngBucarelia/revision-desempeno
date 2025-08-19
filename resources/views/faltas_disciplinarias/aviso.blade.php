<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px">
            <div class="contenido">    
                <h4>Enviar por Aviso por Correo Electrónico</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Número de documento</label>
                    <input type="text" value="{{ $numero_documento }}" id="documento_empleado" class="form-control" placeholder="Número de documento" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo de mensaje</label>
                    <select id="tipo_mensaje" class="form-select">
                        <option value="">-- Seleccionar --</option>
                        <option value="citacion">Mensaje para citación a descargos</option>
                        <option value="decision">Mensaje para respuesta a falta disciplinaria</option>
                        <option value="recibimiento_apelacion">Mensaje de recibimiento de apelación</option>
                        <option value="apelacion">Mensaje para respuesta a apelación de falta disciplinaria</option>
                    </select>
                </div>

                <form action="{{ route('email.send') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="ejemplo@gmail.com" value="{{ $email ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Asunto (opcional)</label>
                        <input type="text" name="subject" id="subject" class="form-control"
                            placeholder="Asunto del mensaje">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mensaje</label>
                        <textarea name="message" id="message" class="form-control" rows="5" required>
Hola, te contacto desde nuestro sistema...
</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="fas fa-paper-plane me-2"></i> ENVIAR CORREO
                    </button>
                </form>
            </div>
            <br>
            <a class="btn btn-warning btn-sm" href="{{ route('dashboard') }}" style="margin-bottom: 5px !important; background:#ab4d1a;">
                <i class="fas fa-edit"></i>🏠 Inicio
            </a><br>
        </div>
    </div>

    @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Formatear número mientras se escribe (mantener si es necesario)
            const phoneInput = document.getElementById('phone');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    const value = e.target.value.replace(/\D/g, '');
                    let formatted = '';
                    if (value.length > 0) {
                        formatted = '+' + value;
                    }
                    e.target.value = formatted;
                });
            }
            
            // Contador de caracteres para el mensaje
            const messageInput = document.getElementById('message');
            const charCounter = document.createElement('small');
            charCounter.className = 'form-text text-muted text-end';
            messageInput.parentNode.appendChild(charCounter);
            messageInput.addEventListener('input', function() {
                charCounter.textContent = `${messageInput.value.length}/500 caracteres`;
            });
        });
    </script>
    @endsection

    <script>
        const empleado_nombre = '{{ $empleado->nombre ?? "trabajador" }}';
        const info_falta = @json($falta);

        function generarDetallesFalta(falta) {
            if (!falta) return '';
            return `
--- Detalles de la Falta Disciplinaria ---
\n
Fecha de la Falta:
-> ${falta.fecha_falta}
\n
Descripción de la Falta:
-> ${falta.descripcion_falta}
\n
Clase de la Falta:
-> ${falta.clase_falta}
\n
Testigo(s):
-> ${falta.nombre_testigo || 'No aplica'}
\n
------------------------------------------
`;
        }
        
        document.getElementById('tipo_mensaje').addEventListener('change', function () {
            const tipo = this.value;
            const nombre = empleado_nombre;
            const falta = info_falta;
            
            let asunto = '';
            let mensaje = '';
            const detallesFalta = generarDetallesFalta(falta);

            switch (tipo) {
                case 'citacion':
                    asunto = "Revisión de desempeños - Citación a descargos";
                    mensaje = `Hola ${nombre},\n\n`;
                    mensaje += `Te informamos que has sido citado(a) a una diligencia de descargos debido a una falta disciplinaria. Por favor, lee los detalles a continuación y acércate a la oficina de Gestión Humana para presentarlos.\n\n`;
                   
                    if (falta) {
                        mensaje += `Fecha de citación :\n* ${falta.fecha_citacion}\n\n`;
                        mensaje += `Hora de citación :\n* ${falta.hora_citacion}\n\n`;
                        mensaje += `--- Detalles de la Falta Disciplinaria ---\n\n`;
                        mensaje += `Descripción de la Falta:\n* ${falta.descripcion_falta}\n\n`;
                        mensaje += `Fecha y Hora de la Falta:\n-> Fecha: ${falta.fecha_falta}\n-> Hora: ${falta.hora_falta}\n\n`;
                        mensaje += `Clase de la Falta:\n-> ${falta.clase_falta}\n\n`;
                        mensaje += `Testigo(s):\n-> ${falta.nombre_testigo || 'No aplica'}\n\n`;
                        mensaje += `Comentarios de Gestión Humana:\n-> ${falta.comentarios_gestion_humana || 'Sin comentarios adicionales.'}\n\n`;
                        mensaje += `------------------------------------------\n`;
                    }
                    mensaje += `\n\nMuchas gracias por tu atención y colaboración.\n\nAtentamente,\nGestión Humana`;
                    break;
                
                case 'decision':
                    asunto = "Revisión de desempeños - Decisión de falta disciplinaria";
                    mensaje = `Estimado(a) ${nombre}, `;
                    if (falta) {
                        mensaje += `\n\nInformación relacionada:\n- Código: ${falta.codigo}\n- Fecha de la falta: ${falta.fecha_falta}\n- Tipo: ${falta.tipo_falta}\n- Clase: ${falta.clase_falta}\n- Descripción: ${falta.descripcion_falta}\n- Labor: ${falta.labor}`;
                    }
                    mensaje += "\n\ntiene hasta 3 dias habiles para presentar apelacion a esta desición\n\nMuchas gracias.";
                    break;
                
                case 'recibimiento_apelacion':
                    asunto = "Acuse de recibo de apelación de falta disciplinaria";
                    mensaje = `Estimado(a) ${nombre}, \n\n`;
                    mensaje += `Se ha recibido su apelación a la falta disciplinaria. \n\n`;
                    mensaje += `En un plazo máximo de 5 días hábiles responderemos. \n\n`;
                    mensaje += `Adjunto la información de la falta a la que se refiere su apelación. \n\n`;
                    mensaje += `\n\n\n\Comentarios de Gestión Humana respecto a la apelacion presentada:\n-> ${falta.comentario_apelacion || 'Sin comentarios adicionales.'}\n\n`;

                    mensaje += detallesFalta;
                    mensaje += `\n\nMuchas gracias.`;
                    break;
                
                case 'apelacion':
                    asunto = "Revisión de desempeños - Respuesta a apelación de falta disciplinaria";
                    mensaje = `Estimado(a) ${nombre}, se ha dado respuesta a su apelación respecto a una falta disciplinaria. Por favor, acercarse a la oficina de Gestión Humana. Muchas gracias.`;
                    if (falta) {
                        mensaje += `\n\nInformación relacionada:\n- Código: ${falta.codigo}\n- Fecha de la falta: ${falta.fecha_falta}\n- Tipo: ${falta.tipo_falta}\n- Clase: ${falta.clase_falta}\n- Descripción: ${falta.descripcion_falta}\n- Labor: ${falta.labor}`;
                    }
                    mensaje += ` \n\n\n\nRespuesta de Gestión Humana respecto a la apelacion presentada:\n\n-> ${falta.respuesta_apelacion || 'Sin comentarios adicionales.'}\n\n`;

                    mensaje += "\n\nMuchas gracias.";
                    break;
                
                default:
                    mensaje = "Hola, te contacto desde nuestro sistema...";
                    break;
            }
            document.getElementById('subject').value = asunto;
            document.getElementById('message').value = mensaje;
        });

        document.getElementById('tipo_mensaje').dispatchEvent(new Event('change'));
    </script>
    <x-footer />
</x-app-layout>