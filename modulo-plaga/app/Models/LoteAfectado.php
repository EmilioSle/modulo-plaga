<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoteAfectado extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'ubicacion', 'tamano', 'cultivo', 'fecha_siembra'];

    public function detecciones()
    {
        return $this->hasMany(Deteccion::class);
    }
}
