<?php

namespace App\Http\Controllers;

use App\Models\Otrosi;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use setasign\Fpdi\Fpdi;

use Illuminate\Support\Facades\Mail;
use App\Mail\FaltaDisciplinariaCreada;
use App\Models\MovimientoOtrosi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class OtrosiController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->input('search');

        $otrosis = Otrosi::with('empleado')
            ->when($query, function ($q) use ($query) {
                $q->whereHas('empleado', function ($sub) use ($query) {
                    $sub->where('nombre', 'LIKE', "%$query%")
                        ->orWhere('codigo', 'LIKE', "%$query%");
                });
            })
            ->latest()
            ->paginate(6);

        // Soporte para búsqueda AJAX
        if ($request->ajax()) {
            return view('otrosis.index', compact('otrosis'))->render();
        }

        return view('otrosis.index', compact('otrosis'));
    }


    public function create(Empleado $empleado)
    {
        return view('otrosis.create', compact('empleado'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'codigo_trabajador' => 'required|exists:empleados,codigo',
            'fecha_renovacion' => 'required|date',
            'periodo' => 'required|string|max:50',
            'numero_prorrogas' => 'required|integer|min:1',
        ]);

        $otrosi = Otrosi::create($request->all());
        MovimientoOtrosi::create([
            'otrosi_id' => $otrosi->id,
            'codigo_otrosi' => $otrosi->codigo ?? $otrosi->id, // cambia según cómo guardas el código
            'usuario_id' => Auth::id(),
            'accion' => 'Creación',
            'fecha_hora' => Carbon::now()
]);

        return redirect()->route('otrosis.index')->with('success', 'Otrosí creado correctamente.');
    }

    public function show($id)
    {
        $otrosi = Otrosi::with('empleado')->findOrFail($id);
        return view('otrosis.show', compact('otrosi'));
    }


    public function verificar($cedula)
    {
        $otrosi = Otrosi::whereHas('empleado', function ($q) use ($cedula) {
            $q->where('codigo', $cedula);
        })->latest()->first();

        if ($otrosi) {
            return response()->json([
                'existe' => true,
                'fecha' => $otrosi->created_at->format('d/m/Y'),
            ]);
        }

        return response()->json(['existe' => false]);
    }

   public function generarPDF($id)
    {
        $proceso = Otrosi::findOrFail($id);

        // 1. Generar PDF desde la vista con DomPDF (contenido en memoria)
        $dompdf = Pdf::loadView('otrosis.pdf_otrosis', compact('proceso'))->setPaper('letter', 'portrait');
        $mainPdfContent = $dompdf->output();

        // 2. Guardar temporalmente el PDF generado
        $tempPath = storage_path('app/temp_otrosi.pdf');
        file_put_contents($tempPath, $mainPdfContent);

        // 3. Cargar con FPDI desde archivo
        $finalPdf = new Fpdi();
        $pageCount = $finalPdf->setSourceFile($tempPath);

        for ($i = 1; $i <= $pageCount; $i++) {
            $tplIdx = $finalPdf->importPage($i);
            $finalPdf->AddPage();
            $finalPdf->useTemplate($tplIdx);
        }

        // 4. Eliminar archivo temporal (opcional)
        unlink($tempPath);

        // 5. Descargar directamente
        return response($finalPdf->Output('I', "Falta_{$proceso->codigo}.pdf"))
            ->header('Content-Type', 'application/pdf');
    }

    public function edit($id)
    {
        $otrosi = Otrosi::with('empleado')->findOrFail($id);
        return view('otrosis.edit', compact('otrosi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_renovacion' => 'required|date',
            'periodo' => 'required|string|max:255',
            'numero_prorrogas' => 'required|integer|min:1',
        ]);

        $otrosi = Otrosi::findOrFail($id);

        $otrosi->update([
            'fecha_renovacion' => $request->fecha_renovacion,
            'periodo' => $request->periodo,
            'numero_prorrogas' => $request->numero_prorrogas,
        ]);

        MovimientoOtrosi::create([
            'otrosi_id' => $otrosi->id,
            'codigo_otrosi' => $otrosi->codigo ?? $otrosi->id,
            'usuario_id' => Auth::id(),
            'accion' => 'Actualización',
            'fecha_hora' => Carbon::now()
        ]);

        return redirect()->route('otrosis.index')->with('success', 'Otrosí actualizado correctamente.');
    }

    public function verMovimientos(Request $request)
    {
        $query = $request->input('search');

        $movimientos = MovimientoOtrosi::with('usuario')
            ->when($query, function ($q) use ($query) {
                $q->where('codigo_otrosi', 'LIKE', "%$query%")
                ->orWhere('accion', 'LIKE', "%$query%")
                ->orWhereHas('usuario', function ($sub) use ($query) {
                    $sub->where('name', 'LIKE', "%$query%");
                });
            })
            ->latest('fecha_hora')
            ->paginate(10);

        if ($request->ajax()) {
            return view('otrosis.movimientos_general', compact('movimientos'))->render();
        }

        return view('otrosis.movimientos_general', compact('movimientos'));
    }


}
