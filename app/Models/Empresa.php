<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Empresa extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const BASE_PATH = 'empresa';

    /**
     * Devuelve la url del logo
     *
     * @param string $value
     * @return string
     */
    public function getLogoUrlAttribute()
    {
        return Storage::url($this->logo);
    }

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
