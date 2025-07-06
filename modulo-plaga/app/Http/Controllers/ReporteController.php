<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
    {
        return Reporte::with('deteccion')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string',
            'deteccion_id' => 'required|exists:deteccions,id',
            'usuario_id' => 'required|integer', // ajusta si usas autenticación
        ]);

        return Reporte::create($data);
    }

    public function show(Reporte $reporte)
    {
        return $reporte->load('deteccion');
    }

    public function update(Request $request, Reporte $reporte)
    {
        $reporte->update($request->all());
        return $reporte;
    }

    public function destroy(Reporte $reporte)
    {
        $reporte->delete();
        return response()->noContent();
    }
}

