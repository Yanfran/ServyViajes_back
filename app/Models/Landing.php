<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landing extends Model
{
    use HasFactory;

    protected $fillable = [
        'nosotros',
        'mensaje',
        'telefono_fijo',
        'telefono_movil',
        'correo_contacto',
        'url_facebook',
        'domicilio',
        'imagen',
        'imagen_mensaje'
    ];

    public function banners()
    {
        return $this->hasMany(LandingBanner::class, 'landing_id');
    }

}
