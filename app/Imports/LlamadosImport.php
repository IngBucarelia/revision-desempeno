<?php
namespace App\Imports;

use App\Models\LlamadoAtencion;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\ToCollection;


class LlamadosImport implements ToCollection, WithHeadingRow
{
    public $noEncontrados = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $documento = trim($row['documento'] ?? '');

            if (empty($documento)) continue;

            $empleado = Empleado::where('codigo', $documento)->first();

            // ⚠️ Log de depuración opcional
            // \Log::info("Verificando documento: $documento");
            if (!$empleado) {
                $this->noEncontrados[] = [
                    'documento' => $documento,
                    'trabajador' => $row['trabajador'] ?? 'Sin nombre'
                ];
                continue;
            }

            // Guardar el registro si el empleado existe
            LlamadoAtencion::create([
                'codigo' => $row['codigo'],
                'documento' => $documento,
                'trabajador' => $row['trabajador'],
                'clase_falta' => $row['clase_falta'],
                'labor' => $row['labor'],
                'fecha_notificacion' => $row['fecha_notificacion'],
                'fecha_falta' => $row['fecha_falta'],
                'asunto' => $row['asunto'],
                'descripcion_falta' => $row['descripcion_falta'],
                'observaciones' => $row['observaciones'],
                'documento_notificacion' => $row['documento_notificacion'],
                'nombre_notificacion' => $row['nombre_notificacion'],
                'firma_notificacion' => $row['firma_notificacion'],
                'cargo' => $row['cargo'],
                'usuario_id' => $row['usuario_id'],
            ]);
        }
    }
}