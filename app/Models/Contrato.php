<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }
    public function tipoContrato()
    {
        return $this->belongsTo(TipoContrato::class);
    }
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
