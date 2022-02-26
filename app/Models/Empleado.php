<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Empleado extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const BASE_PATH = 'product';

    /**
     * Devuelve la url de la foto de perfil
     *
     * @param string $value
     * @return string
     */
    public function getFotoPerfilUrlAttribute()
    {
        return Storage::url($this->foto_perfil);
    }

    /**
     * Devuelve la url del preocupacional
     *
     * @param string $value
     * @return string
     */
    public function getPreocupacionalUrlAttribute()
    {
        return Storage::url($this->preocupacional);
    }

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }
}

