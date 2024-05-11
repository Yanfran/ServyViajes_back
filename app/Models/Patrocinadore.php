<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patrocinadore extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'landing_eventos_id',
        'patrocinador'
    ];

    public function landing_evento() {
        return $this->belongsTo(LandingEvento::class, 'landing_eventos_id');
    }
}