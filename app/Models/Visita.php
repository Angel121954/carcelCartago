<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Visita
 *
 * @property $id
 * @property $prisionero_id
 * @property $visitante_id
 * @property $guardia_id
 * @property $fecha
 * @property $hora_inicio
 * @property $hora_fin
 * @property $created_at
 * @property $updated_at
 *
 * @property Guardia $guardia
 * @property Prisionero $prisionero
 * @property Visitante $visitante
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Visita extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['prisionero_id', 'visitante_id', 'guardia_id', 'fecha', 'hora_inicio', 'hora_fin'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guardia()
    {
        return $this->belongsTo(\App\Models\Guardia::class, 'guardia_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prisionero()
    {
        return $this->belongsTo(\App\Models\Prisionero::class, 'prisionero_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visitante()
    {
        return $this->belongsTo(\App\Models\Visitante::class, 'visitante_id', 'id');
    }
    
}
