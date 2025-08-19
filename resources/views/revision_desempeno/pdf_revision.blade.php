<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>R-CL-01 - Revisión sobre el Desempeño</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            margin: 100px 40px 100px 40px; /* espacio para encabezado y pie */
        }
        header {
            position: fixed;
            top: 10px;
            left: 0;
            right: 0;
            height: 80px;
            margin-bottom: 130px;
        }
        footer {
            position: fixed;
            bottom: 10px;
            left: 0;
            right: 0;
            height: 80px;
        }
        .content {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }
        td, th {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: top;
        }
        .seccion {
            background-color: #c5e1a5;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    {{-- Header con imagen --}}
    <header style="position: fixed; top: 0; left: 0; right: 0; height: 100px;">
        <img src="{{ public_path('images/header_revision.png') }}" style="width: 100%; height: auto;">
    </header>

    {{-- Footer con imagen --}}
    <footer>
        <img src="{{ public_path('images/footer_revision.png') }}" style="width: 100%;">
    </footer>

    {{-- Cuerpo del documento --}}
    <div class="content">
    <table>
        <tr><td colspan="6" class="seccion">DATOS DEL TRABAJADOR</td></tr>
        <tr>
            <td><strong>Fecha de solicitud:</strong></td>
            <td colspan="2">{{ $registro->fecha_solicitud }}</td>
            <td><strong>Fecha vencimiento contrato:</strong></td>
            <td colspan="2">{{ $registro->fecha_vencimiento }}</td>
        </tr>
        <tr>
            <td><strong>Nombre:</strong></td>
            <td colspan="2">{{ $registro->nombre_trabajador }}</td>
            <td><strong>Cargo:</strong></td>
            <td colspan="2">{{ $registro->cargo }}</td>
        </tr>
        <tr>
            <td><strong>Fecha de Ingreso:</strong></td>
            <td>{{ $registro->fecha_ingreso }}</td>
            <td><strong>Prorrogas:</strong></td>
            <td colspan="3">{{ $registro->prorrogas }}</td>
        </tr>
    </table>

    <br>

    <table>
    <tr>
        <td colspan="6" class="seccion">INFORMACIÓN GESTIÓN HUMANA</td>
    </tr>
    <tr>
        <td><strong>Faltas Disciplinarias:</strong></td>
        <td colspan="2">{{ $registro->faltas_disciplinarias }}</td>
        <td><strong>Llamados de Atención:</strong></td>
        <td colspan="2">{{ $registro->llamados_atencion }}</td>
    </tr>
    <tr>
        <td><strong>Sanciones:</strong></td>
        <td colspan="2">{{ $registro->sanciones }}</td>
        <td><strong>Inasistencias:</strong></td>
        <td colspan="2">{{ $registro->inasistencias }}</td>
    </tr>
    <tr>
        <td><strong>Observaciones:</strong></td>
        <td colspan="5">{{ $registro->observaciones_gh }}</td>
    </tr>
    <tr>
        <td><strong>Diligenciado por:</strong></td>
        <td colspan="2">{{ $registro->gh_diligenciado_por }}</td>
        <td><strong>Firma:</strong></td>
        <td colspan="2">
            @if($registro->gh_firma)
                <img src="{{ public_path($registro->gh_firma) }}" style="max-width: 100px; max-height: 50px;">
            @else No registrada
            @endif
        </td>
    </tr>
    <tr>
        <td><strong>Fecha:</strong></td>
        <td colspan="5">{{ $registro->gh_fecha }}</td>
    </tr>
</table>


    <br>

    <table>
        <tr><td colspan="6" class="seccion">INFORMACIÓN SEGURIDAD Y SALUD EN EL TRABAJO</td></tr>
        <tr>
            <td><strong>Cumplimiento de roles y responsabilidades frente al SG-SST:</strong></td>
            <td colspan="5">{{ $registro->cumplimiento_sgsst }}</td>
        </tr>
        <tr>
            <td><strong>Hábitos y comportamientos seguros:</strong></td>
            <td colspan="5">{{ $registro->habitos_comportamientos }}</td>
        </tr>
        <tr>
            <td><strong>Diligenciado por:</strong></td>
            <td>{{ $registro->sst_diligenciado_por }}</td>
            <td><strong>Firma:</strong></td>
            <td>
                @if($registro->sst_firma)
                    <img src="{{ public_path($registro->sst_firma) }}" style="max-width: 100px; max-height: 50px;">
                @else No registrada
                @endif
            </td>
            <td><strong>Fecha:</strong></td>
            <td>{{ $registro->sst_fecha }}</td>
        </tr>
    </table>

    <br>

    <table>
        <tr><td colspan="6" class="seccion">EVALUACIÓN JEFE INMEDIATO</td></tr>
        <tr>
            <td><strong>Labor Actual:</strong></td>
            <td colspan="2">{{ $registro->labor_actual }}</td>
            <td><strong>Labores desempeñadas:</strong></td>
            <td colspan="2">{{ $registro->labores_desempenadas }}</td>
        </tr>
        <tr>
            <td><strong>Diligenciado por:</strong></td>
            <td>{{ $registro->jefe_diligenciado_por }}</td>
            <td><strong>Firma:</strong></td>
            <td>
                @if($registro->jefe_firma)
                    <img src="{{ public_path($registro->jefe_firma) }}" style="max-width: 100px; max-height: 50px;">
                @else No registrada
                @endif
            </td>
            <td><strong>Fecha:</strong></td>
            <td>{{ $registro->jefe_fecha }}</td>
        </tr>
    </table>

    <br>

   <style>
    /* Estilos para prevenir desbordamiento */
    table {
        width: 100% !important;
        table-layout: fixed !important;
        word-wrap: break-word !important;
         border-color: black !important;
        border-style: solid !important;
        border-width: 1px !important;
    }
    
    td, th {
        max-width: 100% !important;
        white-space: normal !important;
        overflow-wrap: break-word !important;
        word-break: break-word !important;
        padding: 5px !important;
        font-size: 12px !important; /* Reducir tamaño de fuente si es necesario */
    }
    
    .seccion {
        background-color: #f2f2f2;
        font-weight: bold;
        text-align: center;
    }
    
    /* Específico para tu tabla */
    @media print {
        table {
            page-break-inside: avoid !important; /* Evita que se divida la tabla entre páginas */
        }
        
        td {
            border: 1px solid #ddd !important; /* Asegurar bordes visibles al imprimir */
        }
    }
</style>

<table style=" border-color: black !important;
        border-style: solid !important;
        border-width: 1px !important;">
    <tr><td colspan="6" class="seccion">OBSERVACIONES SOBRE EL DESEMPEÑO</td></tr>
    <tr>
        <td style="width: 25%;"><strong>Calidad Labor:</strong></td>
        <td style="width: 25%;"><strong>Cumplimiento:</strong></td>
        <td style="width: 25%;"><strong>Productividad:</strong></td>
    </tr>
    <tr>
        <td>{{ $registro->calidad_labor }}</td>
        <td>{{ $registro->cumplimiento }}</td>
        <td>{{ $registro->productividad }}</td>
    </tr>
    <tr>
        <td style="width: 15%;"><strong>Relaciones:</strong></td>
        <td style="width: 35%;">{{ $registro->relaciones }}</td>
        <td style="width: 15%;"><strong>Otras:</strong></td>
        <td style="width: 35%;" colspan="3">{{ $registro->otras }}</td>
    </tr>
</table>
    <br>

    <table >
        <tr><td colspan="6" class="seccion">CUMPLIMIENTO GENERAL</td></tr>
        <tr>
            <td><strong>Gestión Humana:</strong></td>
            <td>{{ $registro->gh_cumple }}</td>
            <td><strong>Seguridad y Salud:</strong></td>
            <td>{{ $registro->sst_cumple }}</td>
            <td><strong>Jefe Inmediato:</strong></td>
            <td>{{ $registro->jefe_cumple }}</td>
        </tr>
    </table>

    <br>

    <table >
        <tr><td colspan="6" class="seccion">REVISIÓN POR LA GERENCIA</td></tr>
        <tr>
            <td><strong>Fecha:</strong></td>
            <td>{{ $registro->fecha_gerencia }}</td>
            <td><strong>Cumple:</strong></td>
            <td colspan="3">{{ $registro->gerencia_cumple }}</td>
        </tr>
        <tr>
            <td><strong>Observaciones:</strong></td>
            <td colspan="3">{{ $registro->observaciones_gerencia }}</td>
        </tr>
        <tr>
            <td><strong>Autorizado por:</strong></td>
            <td colspan="2">{{ $registro->autorizado_por }}</td>
            <td><strong>Firma:</strong></td>
            <td colspan="2">
                @if($registro->firma_autorizado)
                    <img src="{{ public_path($registro->firma_autorizado) }}" style="max-width: 100px; max-height: 50px;">
                @else No registrada
                @endif
            </td>
        </tr>
    </table>
</div>

</body>
</html>
