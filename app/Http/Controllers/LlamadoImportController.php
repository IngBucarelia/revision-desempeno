<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LlamadosImport;

class LlamadoImportController extends Controller
{
    public function showForm()
    {
        return view('llamados_atencion.importar');
    }

    public function import(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:xlsx,xls,csv'
        ]);

        $import = new \App\Imports\LlamadosImport;
        Excel::import($import, $request->file('archivo'));

        $noEncontrados = $import->noEncontrados;

        if (count($noEncontrados) > 0) {
            $mensaje = "Algunos documentos no se encontraron en la tabla empleados:";
            foreach ($noEncontrados as $registro) {
                $mensaje .= "\n• " . $registro['documento'] . " - " . $registro['trabajador'];
            }
 
            return redirect()->back()->with('warning', nl2br($mensaje));
        }

        return redirect()->back()->with('success', 'Archivo de llamados cargado correctamente.');
    }

 
}

