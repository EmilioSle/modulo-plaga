<?php

namespace App\Http\Controllers;

use App\Models\LoteAfectado;
use Illuminate\Http\Request;

class LoteAfectadoController extends Controller
{
    public function index()
    {
        return LoteAfectado::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'ubicacion' => 'required|string',
            'tamano' => 'nullable|numeric',
            'cultivo' => 'required|string',
            'fecha_siembra' => 'nullable|date',
        ]);

        return LoteAfectado::create($data);
    }

    public function show(LoteAfectado $loteAfectado)
    {
        return $loteAfectado;
    }

    public function update(Request $request, LoteAfectado $loteAfectado)
    {
        $loteAfectado->update($request->all());
        return $loteAfectado;
    }

    public function destroy(LoteAfectado $loteAfectado)
    {
        $loteAfectado->delete();
        return response()->noContent();
    }
}
