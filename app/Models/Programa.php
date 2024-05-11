<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Programa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'landing_eventos_id',
        'dia',
        'fecha',
        'horario',
        'modulo_conferencia',
        'coordinador_profesor'
    ];

    public function landing_evento() {
        return $this->belongsTo(LandingEvento::class, 'landing_eventos_id');
    }
}
