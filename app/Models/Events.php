<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    // use HasApiTokens, HasFactory, Notifiable;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'sede',
        'fecha_inicio',
        'fecha_termino',
        'descripcion',
        'politicas',
        'hotel_id',        
        'estatus',
        'beneficiario',
        'banco',
        'numero_cuenta',
        'clabe_interbancaria'        

    ];


    public function hotel()
    {
        return $this->belongsTo(Hotels::class, 'hotel_id');
    }

    // public function servicios()
    // {
    //     return $this->hasMany(ServicesOfHotels::class, 'hotel_id');
    // }


    public function availableCategories()
    {
        return $this->hasMany(AvailableCategories::class, 'events_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'event_category', 'event_id', 'category_id');
    }

    public function landing_eventos() {
        return $this->hasMany(LandingEvento::class, 'event_id');
    }

    public function grados()
    {
        return $this->hasMany(AcademicGrades::class, 'events_id');
    }
    
}
