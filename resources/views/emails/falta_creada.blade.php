<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Falta Disciplinaria</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 30px;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #218838;
            color: white;
            padding: 15px;
            border-radius: 6px 6px 0 0;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        .content {
            padding: 20px 0;
            color: #333;
        }

        .content p {
            margin: 10px 0;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 30px;
        }

        .label {
            font-weight: bold;
            color: #155724;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            📌 Nueva Falta Disciplinaria Registrada
        </div>

        <div class="content">
            <p><span class="label">👤 Empleado:</span> {{ $falta->nombre_trabajador }}</p>
            <p><span class="label">🆔 Documento:</span> {{ $falta->numero_documento_trabajador }}</p>
            <p><span class="label">🗂️ Tipo de Falta:</span> {{ $falta->tipo_falta }}</p>
            <p><span class="label">📅 Fecha del Reporte:</span> {{ \Carbon\Carbon::parse($falta->fecha_reporte)->format('d/m/Y') }}</p>
            <p><span class="label">📝 Descripción:</span><br>{{ $falta->descripcion_falta }}</p>
        </div>

        <div class="footer">
            Sistema de Gestión Disciplinaria - Bucarelia<br>
            Este es un mensaje automático, por favor no responder.
        </div>
    </div>
</body>
</html>
