<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Novedad</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 40px;
        }

        header {
            position: fixed;
            top: 20px;
            left: 0;
            right: 0;
            height: 80px;
            margin-bottom: 250px;
        }
        footer {
            position: absolute;
            bottom: 18px;
            left: 0;
            right: 0;
            height: 80px;
            margin-top: -200px !important
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .titulo {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 20px;
        }

        td, th {
            border: 1px solid black;
            padding: 6px;
            vertical-align: middle;
            text-align: center;
        }

        .sin-borde {
            border: none !important;
        }

        .observaciones {
            height: 50px;
        }

        .firmas {
            margin-top: -10px;
           
        }

        .firma-col {
            width: 50%;
            text-align: center;
        }

        .firma-linea {
            border-bottom: 1px solid black;
            width: 80%;
            margin: auto;
            margin-bottom: 4px;
        }
            /* Estilos específicos para impresión */
    @media print {
        table {
            border-collapse: collapse !important;
            width: 100% !important;
        }
        
        table, th, td {
            border: 1px solid black !important; /* Bordes negros sólidos */
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        .seccion {
            background-color: #f2f2f2 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    }

    /* Estilos generales para pantalla */
    table {
        border-collapse: collapse;
        width: 100%;
    }
    
    td, th {
        border: 1px solid #ddd;
        padding: 8px;
        word-break: break-word;
    }
    
    .seccion {
        background-color: #f2f2f2;
        font-weight: bold;
        text-align: center;
    }
    </style>
    
</head>
<body>

    <table>
        <tr>
            <td>
        <img src="{{ public_path('images/novedad_header.png') }}" style="width: 100%;">
    </td>
        </tr>
        <tr>
            <td>
                <p style="text-align: left;"><strong>Fecha de reporte:</strong> {{ $novedad->fecha_reporte }} <br> <br> Marque  con  una   X   el  tipo  de  novedad	<br>D = Desvinculaciòn	<br> R = Renovaciòn	<br>C = Cambio Modalidad de contrato	<br></p>
            </td>
            
        </tr>
    </table>

    

    <table>
        <tr>
            <th>D</th>
            <th>R</th>
            <th>C</th>
            <th>Nombre Trabajador</th>
            <th>Código Trabajador</th>
            <th>Fecha de Novedad</th>
            <th>Tiempo de Prórroga<br>(solo renovación)</th>
            <th>Tipo Contrato</th>
        </tr>
        <tr>
            <td>@if($novedad->tipo_novedad == 'D') X @endif</td>
            <td>@if($novedad->tipo_novedad == 'R') X @endif</td>
            <td>@if($novedad->tipo_novedad == 'C') X @endif</td>
            <td>{{ $novedad->nombre_trabajador }}</td>
            <td>{{ $novedad->codigo_trabajador }}</td>
            <td>{{ $novedad->fecha_novedad }}</td>
            <td>{{ $novedad->tipo_novedad == 'R' ? $novedad->tiempo_prorroga : '' }}</td>
            <td>{{ $novedad->tipo_contrato }}</td>
        </tr>
    </table>

    <table>
         <tr>
            <td>
                <p style="text-align: left;"><strong>Observaciones:</strong></p>
            </td>
        </tr>
        <tr>
            <td style="text-align: justify" class="observaciones">{{ $novedad->observaciones }}</td>
        </tr>
    </table>

  

    <table class="firmas">
        <tr style="border: none">
            <td class="firma-col"><br><br><br><br><br><br>
                <div class="firma-linea"></div>
                Diligenciado por: {{ $novedad->diligenciado_por }}<br>
                <em>Asistente de Contratación Laboral</em>
            </td>
            <td class="firma-col"><br><br><br><br><br><br>
                <div class="firma-linea"></div>
                Autorizado por: {{ $novedad->autorizado_por }}<br>
                <em>Directora de Gestión Humana</em>
            </td>
        </tr>
       
    </table>
    <table>
         <tr>
            <td>
                <img src="{{ public_path('images/footer_novedad.png') }}" style="width: 100%;margin-top:20px;">
            </td>
        </tr>
    </table>
<footer>
        
    </footer>
</body>
</html>
