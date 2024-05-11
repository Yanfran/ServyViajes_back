<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event_id',
        'hotel_id',
        'plan_id',
        'fecha_entrada',
        'fecha_salida',
        'cantidad_noches',
        'nombre_solicitante',
        'apellido_solicitante',
        'correo_solicitante',
        'telefono_solicitante',
        'ciudad_solicitante',
        'monto_total',
        'estatus',
        'user_id',
        'observaciones',
        'clave_reservation'
    ];

    public function reservationDetails()
    {
        return $this->hasMany(ReservationDetails::class, 'reservation_id');
    }

    public function reservationRooms()
    {
        return $this->hasMany(ReservationRooms::class, 'reservation_id');
    }

    public function plans()
    {
        return $this->belongsTo(PlanTypes::class, 'plan_id');
    }

    public function payments()
    {
        return $this->belongsTo(PaymentTypes::class, 'payment_id');
    }

    public function reservePayments()
    {
        return $this->hasMany(ReservePayments::class, 'reservation_id');
    }

    public function hotel() {
        return $this->belongsTo(Hotels::class, 'hotel_id');
    }


}