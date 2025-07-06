<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plaga extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_comun', 'nombre_cientifico', 'descripcion', 'imagen_referencia'];

    public function medidas()
    {
        return $this->hasMany(MedidaSugerida::class);
    }

    public function detecciones()
    {
        return $this->hasMany(Deteccion::class);
    }
}
