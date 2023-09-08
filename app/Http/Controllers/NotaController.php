<?php

namespace App\Http\Controllers;

use App\Models\Notas\Nota;
use Illuminate\Http\Request;

class NotaController extends Controller
{

    public function index()
    {
        $notas = Nota::whereNull('deleted_at')->get();
        $notasDelete = Nota::onlyTrashed()->get();
        return view('notas.index', compact('notas','notasDelete'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'nombre' => 'required',
           'descripcion' => 'required',
           'estado' => 'required',
           'archivo' => 'nullable',
        ]);
        $notas = $request->all();

        Nota::create($notas);
        return redirect()->route('notas.index')->with('success', 'Apunte generado Correctamente.');
    }

    public function edit(Nota $nota)
    {
        return view('notas.index', compact('nota'));
    }

    public function update(Request $request, Nota $nota)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'estado' => 'required',
            'archivo' => 'nullable',
        ]);
        $data = $request->all();

        $nota->update($data);
        return redirect()->route('notas.index')->with('success', 'Apunte actualizado Correctamente.');
    }

    public function destroy(Nota $nota)
    {
        $nota->delete();
        return redirect()->route('notas.index')->with('success', 'Apunte eliminado Correctamente.');
    }

}
