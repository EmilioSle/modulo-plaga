<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedidaSugerida extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion', 'tipo', 'plaga_id'];

    public function plaga()
    {
        return $this->belongsTo(Plaga::class);
    }
}

