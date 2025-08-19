<?php
namespace App\Http\Controllers;
use App\Imports\ProcesosDisciplinariosImport;


use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProcesoDisciplinarioImportController extends Controller
{
    public function showForm()
    {
        return view('faltas_disciplinarias.importar');
    } 

   public function import(Request $request)
    {

        $request->validate([
            'archivo' => 'required|file|mimes:xlsx,xls,csv|max:2048'
        ]);


        $import = new ProcesosDisciplinariosImport();
        Excel::import($import, $request->file('archivo'));


        $noEncontrados = $import->noEncontrados;

        if (count($noEncontrados) > 0) {
            $mensaje = "Algunos documentos no se encontraron en la tabla empleados:";
            foreach ($noEncontrados as $registro) {
                $mensaje .= "\n• " . $registro['documento'] . " - " . $registro['trabajador'];
            }

            return redirect()->back()->with('warning', nl2br($mensaje));
        }

        return redirect()->back()->with('success', 'Faltas disciplinarias importadas correctamente.');
        
    }



}
