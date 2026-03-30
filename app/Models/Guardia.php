<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Guardia
 *
 * @property $id
 * @property $nombre_completo
 * @property $numero_identificacion
 * @property $activo
 * @property $created_at
 * @property $updated_at
 *
 * @property SesionGuardia[] $sesionGuardias
 * @property Visita[] $visitas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Guardia extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre_completo', 'numero_identificacion', 'activo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sesionGuardias()
    {
        return $this->hasMany(\App\Models\SesionGuardia::class, 'id', 'guardia_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visitas()
    {
        return $this->hasMany(\App\Models\Visita::class, 'id', 'guardia_id');
    }
    
}
