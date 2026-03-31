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
        'user_id' // IMPORTANTE
    ];

    //  RELACIÓN CON USER
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    //  RELACIÓN CON SESIONES
    public function sesionGuardias()
    {
        return $this->hasMany(\App\Models\SesionGuardia::class, 'guardia_id', 'id');
    }

    //  RELACIÓN CON VISITAS
    public function visitas()
    {
        return $this->hasMany(\App\Models\Visita::class, 'guardia_id', 'id');
    }
}
