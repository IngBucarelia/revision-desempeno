<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmpleadosImport;
use PhpOffice\PhpSpreadsheet\IOFactory;


class EmpleadoImportController extends Controller
{
    public function showForm()
    {
        return view('empleados.importar');
    }
 
 public function import(Request $request)
    {
        $request->validate([
            'archivo' => 'required|mimes:xlsx,csv'
        ]);

        $archivo = $request->file('archivo');
        $extension = $archivo->getClientOriginalExtension();
        $data = [];

        if ($extension === 'csv') {
            $data = array_map('str_getcsv', file($archivo));
        } else {
            $data = IOFactory::load($archivo)->getActiveSheet()->toArray();
        }

        $encabezado = array_map('trim', array_map('strtolower', $data[0]));
        unset($data[0]); // quitar encabezado

        foreach ($data as $fila) {
            $registro = array_combine($encabezado, $fila);

            if (!isset($registro['codigo']) || empty($registro['codigo'])) continue;

            Empleado::updateOrCreate(
                ['codigo' => $registro['codigo']],
                [
                    'nombre'             => $registro['nombre'] ?? '',
                    'fecha_ingreso'      => $this->validarFecha($registro['fecha_ingreso']),
                    'labor'              => $registro['labor'] ?? '',
                    'rol'                => $registro['rol'] ?? '',
                    'periodo_prueba'     => $this->validarFecha($registro['periodo_prueba']),
                    'numero_contrato'    => $registro['numero_contrato'] ?? '',
                    'correo'             => $registro['correo'] ?? '',
                    'telefono'           => $registro['telefono'] ?? '',
                    'estado_civil'       => $registro['estado_civil'] ?? '',
                    'fecha_terminacion'  => $this->validarFecha($registro['fecha_terminacion']),
                    'id_jefe'       => $registro['id_jefe'] ?? '',
                    'estado'    => $registro['estado'] ?? '',

                ]
            );
        }

        return redirect()->route('empleados.index')->with('success', 'Empleados importados correctamente.');
    }

    private function validarFecha($fecha)
    {
        if (empty($fecha) || trim($fecha) === '') {
            return null;
        }

        // Intenta formatear la fecha
        try {
            return date('Y-m-d', strtotime($fecha));
        } catch (\Exception $e) {
            return null;
        }
    }
}