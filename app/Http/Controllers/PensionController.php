<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pension;

class PensionController extends Controller
{
    public function index()
    {
        $pensiones = Pension::all();
        return view('pension.index', compact('pensiones'));
    }

    public function create()
    {
        return view('pension.create');
    }

    public function store(Request $request)
    {
        Pension::create($request->validate([
            'codigo' => 'required|unique:banco|max:10',
            'nombre' => 'required|string|max:255',
        ]));
        return redirect()->route('pension.index');
    }

    public function edit(Pension $pension)
    {
        return view('pension.edit', compact('pension'));
    }

    public function update(Request $request, Pension $pension)
    {
        $pension->update($request->validate([
            'codigo' => 'required|max:10',
            'nombre' => 'required|string|max:255',
        ]));
        return redirect()->route('pension.index');
    }

    public function destroy(Pension $pension)
    {
        $pension->delete();
        return redirect()->route('pension.index');
    }
}