<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recordatorio;

class RecordatorioController extends Controller {
    public function index() {
        return view('recordatorios.index', ['recordatorios' => Recordatorio::all()]);
    }
    public function create() {
        return view('recordatorios.create');
    }
    public function store(Request $request) {
        Recordatorio::create($request->all());
        return redirect()->route('recordatorios.index');
    }
    public function show($id) {
        return view('recordatorios.show', ['recordatorio' => Recordatorio::findOrFail($id)]);
    }
    public function edit($id) {
        return view('recordatorios.edit', ['recordatorio' => Recordatorio::findOrFail($id)]);
    }
    public function update(Request $request, $id) {
        Recordatorio::findOrFail($id)->update($request->all());
        return redirect()->route('recordatorios.index');
    }
    public function destroy($id) {
        Recordatorio::findOrFail($id)->delete();
        return redirect()->route('recordatorios.index');
    }
}
