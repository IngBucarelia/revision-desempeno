<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>R-48-207 - Faltas Disciplinarias</title>
    <style>
         body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 11px;
        /* Aumenta el margen superior para evitar la superposición del encabezado. */
        margin: 100px 40px 100px 40px; 
        }
        header {
            position: fixed;
            top: -20px;
            left: 0;
            right: 0;
            height: 80px;
            margin-bottom: 130px !important;
        }
        footer {
            position: fixed;
            bottom: 8px;
            left: 0;
            right: 0;
            height: 80px;
        }
        /* Elimina el margen superior del .content, ya que el margen del body ya lo maneja. */
        .content {
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td, th {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: top;
        }
        .campo-multilinea {
            border-bottom: 1px solid black;
            padding: 4px;
            font-size: 11px;
            line-height: 1.4;
            word-wrap: break-word;
            word-break: break-word;
            text-align: justify;
            min-height: 40px;
            margin-top: 5px; /* Ajuste para un espaciado más limpio */
            margin-bottom: 15px; /* Espacio para separar de la siguiente sección */
        }
        /* Estilo para las líneas de firma */
        .linea-firma {
            border-bottom: 1px solid #000;
            height: 1px;
            width: 150px; /* Ancho de la línea para la firma */
            display: inline-block;
        }
        .etiqueta {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <header>
        <img src="{{ public_path('images/encabezado_falta.png') }}" style="width: 100%;">
    </header>

    <footer>
        <img src="{{ public_path('images/footer_falta.png') }}" style="width: 100%;">
    </footer>

    <div class="content">
        <p><strong class="etiqueta">Nombre del trabajador:</strong> {{ $proceso->nombre_trabajador }}</p>
        <p><strong class="etiqueta">Fecha y hora de cometida la falta:</strong> {{ $proceso->fecha_falta }} {{ $proceso->hora_falta }}</p>
        <p><strong class="etiqueta">Fecha y hora en que se conoció la falta:</strong> {{ $proceso->fecha_reporte }} {{ $proceso->hora_reporte }}</p>

        <p><strong class="etiqueta">Descripción de la falta disciplinaria:</strong></p>
        <div class="campo-multilinea">
            {{ $proceso->descripcion_falta }}
        </div>

        <p><strong class="etiqueta">Nombre y/o cargos de las personas que presenciaron la falta disciplinaria:</strong></p>
        <div class="campo-multilinea">
            {{ $proceso->nombre_testigo }} - {{ $proceso->cargo_testigo }}
        </div>

        <p><strong class="etiqueta">Descripción de las evidencias adicionales que se anexan al presente registro <small style="color: rgb(113, 113, 113)">(fotos, videos, etc):</small></strong></p>
        <p><small>(Demuestre claramente las pruebas de los hechos que permitan identificar la falta disciplinaria)</small></p>
        <div class="campo-multilinea">
            {{ $proceso->evidencias_adicionales }}
        </div>

        <p><strong class="etiqueta">Comentarios adicionales:</strong></p>
        <div class="campo-multilinea">
            {{ $proceso->comentarios_adicionales }}
        </div>

        @if($proceso->comentario_apelacion)
            <p><strong class="etiqueta">Apelación Presentada:</strong></p>
            <div class="campo-multilinea">
                {{ $proceso->comentario_apelacion }}
            </div>
        @endif

        @if($proceso->respuesta_apelacion)
            <p><strong class="etiqueta">Respuesta a Apelación:</strong></p>
            <div class="campo-multilinea">
                {{ $proceso->respuesta_apelacion }}
            </div>
        @endif

        <br><br>
        <table style="width: 100%;">
            <tr>
                <td style="border: none;">
                    <strong class="etiqueta">Firma del Director de área:</strong><br><span class="linea-firma"></span>
                </td>
                <td style="border: none;">
                    <strong class="etiqueta">Fecha y hora:</strong><br><span class="linea-firma"></span>
                </td>
            </tr>
            <tr>
                <td style="border: none;">
                    <strong class="etiqueta">Firma de quien reporta el informe:</strong><br><span class="linea-firma"></span>
                </td>
                <td style="border: none;">
                    <strong class="etiqueta">Fecha y hora:</strong><br><span class="linea-firma"></span>
                </td>
            </tr>
            <tr>
                <td style="border: none;">
                    <strong class="etiqueta">Firma de quien recibe el informe:</strong><br><span class="linea-firma"></span>
                </td>
                <td style="border: none;">
                    <strong class="etiqueta">Fecha y hora:</strong><br><span class="linea-firma"></span>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>