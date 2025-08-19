<?php

namespace App\Imports;

use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmpleadosImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Empleado([
            'codigo' => $row['codigo'],
            'nombre' => $row['nombre'],
            'fecha_ingreso' => $row['fecha_ingreso'],
            'periodo_prueba' => $row['periodo_prueba'],
            'id_cia' => $row['id_cia'],
            'id_cargo' => $row['id_cargo'],
            'id_co' => $row['id_co'],
            'id_tipo_cotizante' => $row['id_tipo_cotizante'],
            'id_ccosto' => $row['id_ccosto'],
            'id_centro_trabajo' => $row['id_centro_trabajo'],
            'id_tipo_nomina' => $row['id_tipo_nomina'],
            'numero_contrato' => $row['numero_contrato'],
            'correo' => $row['correo'],
            'telefono' => $row['telefono'],
            'estado_civil' => $row['estado_civil'],
            'id_jefe' => $row['id_jefe'],
        ]);
    }
}
