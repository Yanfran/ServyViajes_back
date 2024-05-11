<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomsByHotels extends Model
{
    use HasFactory;
    // use HasApiTokens, HasFactory, Notifiable;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hotel_id',
        'plan_id',
        'tipo_habitacion',
        'precio_adulto',
        'sencilla',
        'doble',
        'triple',
        'cuadruple',
        'infante_edad_minima',
        'infante_edad_maxima',
        'infante_precio_menores',
        'edad_minima',
        'edad_maxima',
        'precio_menores',
        'aplica',
        'junior_edad_minima',
        'junior_edad_maxima',
        'junior_precio_menores',
        'habitaciones_disponibles',        
        'vigencia',        
        'estatus', 
        'cantidad_registrada',       
    ];


    public function hotel()
    {
        return $this->belongsTo(Hotels::class, 'hotel_id');
    }    

    public function plan()
    {
        return $this->belongsTo(PlanTypes::class, 'plan_id');
    }    
    
    
    
}
