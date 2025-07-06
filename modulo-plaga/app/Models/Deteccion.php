<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deteccion extends Model
{
    use HasFactory;

    protected $fillable = ['fecha', 'imagen', 'resultado_ia', 'plaga_id', 'lote_afectado_id'];

    public function plaga()
    {
        return $this->belongsTo(Plaga::class);
    }

    public function lote()
    {
        return $this->belongsTo(LoteAfectado::class, 'lote_afectado_id');
    }

    public function reporte()
    {
        return $this->hasOne(Reporte::class);
    }
}
