<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Plaga;
use Illuminate\Http\Request;

class PlagaController extends Controller
{
    public function index()
    {
        return Plaga::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_comun' => 'required|string',
            'nombre_cientifico' => 'required|string',
            'descripcion' => 'nullable|string',
            'imagen_referencia' => 'nullable|string',
        ]);

        return Plaga::create($data);
    }

    public function show(Plaga $plaga)
    {
        return $plaga;
    }

    public function update(Request $request, Plaga $plaga)
    {
        $plaga->update($request->all());
        return $plaga;
    }

    public function destroy(Plaga $plaga)
    {
        $plaga->delete();
        return response()->noContent();
    }
}

