<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guardia extends Model
{
    use HasFactory;

    protected $perPage = 20;

    protected $fillable = [
        'nombre_completo',
        'numero_identificacion',
        'activo',
    ];

    public function sesionGuardias()
    {
        return $this->hasMany(SesionGuardia::class, 'guardia_id', 'id');
    }

    public function visitas()
    {
        return $this->hasMany(Visita::class, 'guardia_id', 'id');
    }
}
