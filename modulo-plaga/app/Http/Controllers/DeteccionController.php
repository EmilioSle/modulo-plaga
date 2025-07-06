<?php

namespace App\Http\Controllers;

use App\Models\Deteccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DeteccionController extends Controller
{
    public function index()
    {
        return Deteccion::with(['plaga', 'lote'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'fecha' => 'required|date',
            'imagen' => 'nullable|string',
            'resultado_ia' => 'nullable|string',
            'plaga_id' => 'nullable|exists:plagas,id',
            'lote_afectado_id' => 'required|exists:lotes_afectados,id',
        ]);

        return Deteccion::create($data);
    }

    public function show(Deteccion $deteccion)
    {
        return $deteccion->load(['plaga', 'lote']);
    }

    public function update(Request $request, Deteccion $deteccion)
    {
        $deteccion->update($request->all());
        return $deteccion;
    }

    public function destroy(Deteccion $deteccion)
    {
        $deteccion->delete();
        return response()->noContent();
    }

    public function detectarConIA(Request $request)
    {
        $request->validate([
            'imagen_base64' => 'required|string',
            'lote_afectado_id' => 'required|exists:lotes_afectados,id',
        ]);

        $base64 = $request->imagen_base64;

        // Extraer solo los datos base64
        $base64Data = preg_replace('#^data:image/\w+;base64,#i', '', $base64);
        $imageName = 'deteccion_' . Str::random(10) . '.jpg';
        $imagePath = 'public/detecciones/' . $imageName;

        // Guardar imagen localmente
        Storage::put($imagePath, base64_decode($base64Data));

        // Enviar imagen a Hugging Face (modelo de clasificación de imágenes)
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('HUGGINGFACE_API_KEY'),
            'Content-Type' => 'application/octet-stream',
        ])->withBody(base64_decode($base64Data), 'application/octet-stream')
          ->post('https://api-inference.huggingface.co/models/google/vit-base-patch16-224');

        $resultadoIA = $response->json()[0]['label'] ?? 'Desconocido';

        // Guardar en la base de datos
        $deteccion = Deteccion::create([
            'fecha' => now(),
            'imagen' => Storage::url($imagePath),
            'resultado_ia' => $resultadoIA,
            'plaga_id' => null,
            'lote_afectado_id' => $request->lote_afectado_id,
        ]);

        return response()->json([
            'mensaje' => 'Detección registrada',
            'resultado_ia' => $resultadoIA,
            'deteccion' => $deteccion
        ]);
    }
}
