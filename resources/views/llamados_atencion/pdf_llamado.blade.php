<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>R-48-207 - Faltas Disciplinarias</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            margin: 100px 40px 100px 40px; /* espacio para encabezado y footer */
        }
        header {
            position: fixed;
            top: -20px;
            left: 0;
            right: 0;
            height: 80px;
        }
        footer {
            position: fixed;
            bottom: 18px;
            left: 0;
            right: 0;
            height: 80px;
        }
        .content {
            margin-top: 80px;
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
    </style>
</head>
<body>

    <header>
        <img src="{{ public_path('images/encabezado_llamado.png') }}" style="width: 100%;">
    </header>

   

    <div class="content" style="line-height: 1.8;">
    <p>El pedral, Puerto Wilches, {{ \Carbon\Carbon::parse($proceso->fecha_notificacion)->translatedFormat('F d \d\e Y') }}.</p>


    <p>Señor:</p>
    <p><strong>{{ $proceso->trabajador }}</strong></p>
    <p><strong>{{ $proceso->labor }}</strong></p>
    <p>E.S.M.</p>


    <p><strong>Asunto: Recordatorio de Funciones</strong></p>

    

    <p>
        De acuerdo a lo informado por el supervisor <strong>{{ $proceso->nombre_notificacion }}</strong>
        el día {{ \Carbon\Carbon::parse($proceso->fecha_falta)->format('d/m/Y') }} el operario
        <strong>{{ $proceso->trabajador }}</strong>, {{ $proceso->descripcion_falta }}
    </p>



    <p>
        Por lo anterior lo invito a tomar conciencia de sus acciones repercuten en los resultados
        de la compañía y por eso se hace indispensable que se cumpla estrictamente lo establecido
        por la empresa.
    </p>

    <br>
    <p>___________________________________</p>
    <p><strong>{{ $proceso->nombre_notificacion }}</strong></p>
    <p>Director de {{ $proceso->cargo ?? 'Área correspondiente' }}</p>
</div>

 <footer>
        <img src="{{ public_path('images/footer_llamado.png') }}" style="width: 100%;">
    </footer>
</body>
</html>
