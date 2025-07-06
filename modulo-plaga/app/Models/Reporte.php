<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $fillable = ['fecha', 'descripcion', 'deteccion_id', 'usuario_id'];

    public function deteccion()
    {
        return $this->belongsTo(Deteccion::class);
    }
}
