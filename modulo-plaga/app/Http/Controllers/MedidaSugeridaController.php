<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\MedidaSugerida;
use Illuminate\Http\Request;

class MedidaSugeridaController extends Controller
{
    public function index()
    {
        return MedidaSugerida::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'descripcion' => 'required|string',
            'tipo' => 'required|string',
            'plaga_id' => 'required|exists:plagas,id',
        ]);

        return MedidaSugerida::create($data);
    }

    public function show(MedidaSugerida $medidaSugerida)
    {
        return $medidaSugerida;
    }

    public function update(Request $request, MedidaSugerida $medidaSugerida)
    {
        $medidaSugerida->update($request->all());
        return $medidaSugerida;
    }

    public function destroy(MedidaSugerida $medidaSugerida)
    {
        $medidaSugerida->delete();
        return response()->noContent();
    }
}
