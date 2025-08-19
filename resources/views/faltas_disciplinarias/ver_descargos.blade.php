<x-app-layout>
    <x-appbar />
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <style>
        /* Estilos específicos para esta página para evitar conflictos */
        .container {
            max-width: 900px;
        }
        .card-header {
            font-weight: bold;
        }
        .table {
            margin-bottom: 0;
        }
        .table td {
            vertical-align: top;
            word-wrap: break-word;
            white-space: normal;
        }
        .accordion-button {
            font-weight: bold;
        }
        .accordion-body {
            background-color: #f8f9fa;
        }

        /* Reglas de CSS para forzar la visibilidad del acordeón.
           Esto es un workaround para un problema de JavaScript.
           Garantiza que el contenido no se oculte, aunque puede
           perder la animación de apertura y cierre.
        */
        #accordionExample .accordion-collapse:not(.collapse) {
            display: block !important;
        }
        
        #accordionExample .accordion-collapse.show {
            height: auto !important;
            visibility: visible !important;
            display: block !important;
        }
    </style>

    <div class="contenedor-principal">
        <x-sidebar />
        <div class="container mt-4">
            <h2 class="titulo_formulario">Detalles del Descargo</h2>
            <p><strong>Falta Disciplinaria ID:</strong> {{ $falta->id }}</p>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Información Básica del Empleado
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body p-0">
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold" style="width: 30%;">Dirección:</td>
                                        <td>{{ $descargo->direccion_trabajador }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Teléfono:</td>
                                        <td>{{ $descargo->telefono_trabajador }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Labor:</td>
                                        <td>{{ $descargo->labor }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Preguntas y Respuestas
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table table-bordered">
                                <tbody>
                                    @foreach($preguntas as $key => $pregunta)
                                        <tr>
                                            <td class="font-weight-bold" style="width: 40%;">{{ $pregunta }}</td>
                                            <td>{{ $descargo->{$key} }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Comentarios y Firmas
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body p-0">
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold" style="width: 30%;">Comentarios Adicionales:</td>
                                        <td>{{ $descargo->comentarios }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Firma del Implicado:</td>
                                        <td>{{ $descargo->firma_implicado }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Firma del Responsable:</td>
                                        <td>{{ $descargo->firma_responsable }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4">Volver</a>
        </div>
    </div>
</x-app-layout>