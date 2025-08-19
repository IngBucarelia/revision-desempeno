<?php

namespace App\Imports;

use App\Models\FaltaDisciplinaria;
use App\Models\Empleado;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
 
class ProcesosDisciplinariosImport implements ToCollection, WithHeadingRow
{
    public $noEncontrados = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $documento = trim($row['numero_documento_trabajador'] ?? '');

            if (empty($documento)) continue;

            $empleado = Empleado::where('codigo', $documento)->first();

            if (!$empleado) {
                $this->noEncontrados[] = [
                    'documento' => $documento,
                    'trabajador' => $row['nombre_trabajador'] ?? 'Sin nombre'
                ];
                continue;
            }

            FaltaDisciplinaria::create([
                'codigo' => $row['codigo'] ?? null,
                'numero_documento_trabajador' => $documento,
                'nombre_trabajador' => $row['nombre_trabajador'] ?? null,
                'tipo_falta' => $row['tipo_falta'] ?? null,
                'estado' => $row['estado'] ?? null,
                'fecha_reporte' => $this->parseDate($row['fecha_reporte']),
                'hora_reporte' => $this->parseTime($row['hora_reporte']),
                'fecha_falta' => $this->parseDate($row['fecha_falta']),
                'hora_falta' => $this->parseTime($row['hora_falta']),
                'clase_falta' => $row['clase_falta'] ?? null,
                'labor' => $row['labor'] ?? null,
                'cantidad' => (int) ($row['cantidad'] ?? 0),
                'descripcion_falta' => $row['descripcion_falta'] ?? null,
                'nombre_testigo' => $row['nombre_testigo'] ?? null,
                'cargo_testigo' => $row['cargo_testigo'] ?? null,
                'evidencias_adicionales' => $row['evidencias_adicionales'] ?? null,
                'comentarios_adicionales' => $row['comentarios_adicionales'] ?? null,
                'comentarios_gestion_humana' => $row['comentarios_gestion_humana'] ?? null,
                'pdf_evidencia' => $row['pdf_evidencia'] ?? null,
                'descargo' => $this->booleanFromText($row['descargo'] ?? ''),
                'llamado_atencion' => $this->booleanFromText($row['llamado_atencion'] ?? ''),
                'sancion' => $this->booleanFromText($row['sancion'] ?? ''),
                'terminacion_contrato' => $this->booleanFromText($row['terminacion_contrato'] ?? ''),
                'usuario_id' => $row['usuario_id'] ?? null,
                'estado' => $row['estado'] ?? null,
            ]);
        }
    }

    private function parseDate($value)
    {
        if (empty($value)) return null;

        try {
            if ($value instanceof \Carbon\Carbon) {
                return $value;
            }

            if (is_numeric($value)) {
                // Si es serial de Excel, conviértelo
                return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
            }

            if (strpos($value, ' ') !== false) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $value);
            }

            return Carbon::createFromFormat('Y-m-d', $value);
        } catch (\Exception $e) {
            return null;
        }
    }

    private function parseTime($value)
    {
        if (empty($value)) return null;

        try {
            if (is_numeric($value)) {
                // Convierte número decimal de Excel a tiempo
                $time = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
                return $time->format('H:i:s');
            }

            // Si es texto tipo 08:00 o 8:00 AM
            return Carbon::parse($value)->format('H:i:s');
        } catch (\Exception $e) {
            return null;
        }
    }



    private function booleanFromText($value)
    {
        return in_array(strtolower(trim($value)), ['1', 'sí', 'si', 'x']) ? 1 : 0;
    }
}
