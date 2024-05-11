<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LandingEvento extends Model
{
    use HasFactory;
    use SoftDeletes; //borrado logico

    protected $fillable = [
        'color_fondo',
        'event_id',
        'logo_evento',
        'logo_asociacion',
        'que_incluye',
        'pdf_programa',
        'status',
        'facebook',
        'instagram',
        'whatsapp',
        'twitter',
        'iframe_maps',
        'show_hotel',
        'show_event'
    ];

    public function patrocinadores() {
        return $this->hasMany(Patrocinadore::class, 'landing_eventos_id');
    }

    public function programas() {
        return $this->hasMany(Programa::class, 'landing_eventos_id');
    }

    public function banners() {
        return $this->hasMany(Banner::class, 'landing_eventos_id');
    }

    public function evento() {
        return $this->belongsTo(Events::class, 'event_id');
    }
}
