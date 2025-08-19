<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Banco;

class BancoController extends Controller
{
    public function index()
    {
        $bancos = Banco::all();
        return view('bancos.index', compact('bancos'));
    }

    public function create()
    {
        return view('bancos.create');
    }

    public function store(Request $request)
    {
        Banco::create($request->validate([
            'codigo' => 'required|unique:banco|max:10',
            'nombre' => 'required|string|max:255',
        ]));
        return redirect()->route('bancos.index');
    }

    public function edit(Banco $banco)
    {
        return view('bancos.edit', compact('banco'));
    }

    public function update(Request $request, Banco $banco)
    {
        $banco->update($request->validate([
            'codigo' => 'required|max:10',
            'nombre' => 'required|string|max:255',
        ]));
        return redirect()->route('bancos.index');
    }

    public function destroy(Banco $banco)
    {
        $banco->delete();
        return redirect()->route('bancos.index');
    }
}