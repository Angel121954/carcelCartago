<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SesionGuardia extends Model
{
    use HasFactory;

    protected $table = 'sesion_guardias';

    protected $fillable = [
        'guardia_id',
        'fecha_hora_inicio'
    ];

    public function guardia()
    {
        return $this->belongsTo(\App\Models\Guardia::class);
    }
}