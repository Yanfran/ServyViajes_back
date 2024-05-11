<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
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
        'direccion',
        'descripcion',
        'politicas',
        'check_in',
        'check_out',
        'estatus',
        'beneficiario',
        'banco',
        'numero_cuenta',
        'clabe_interbancaria'
    ];
    

    public function servicios()
    {
        return $this->hasMany(ServicesOfHotels::class, 'hotel_id');
    }


    public function galleries()
    {
        return $this->hasMany(Galleries::class, 'gallery_id');
    }

    public function roomsByHotels()
    {
        return $this->hasMany(RoomsByHotels::class, 'hotel_id');
    }

    public function reservations() {
        return $this->hasMany(Reservations::class, 'hotel_id');
    }
        
}