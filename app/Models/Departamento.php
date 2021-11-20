<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
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

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function cargos()
    {
        return $this->hasMany(Cargo::class);
    }
}
