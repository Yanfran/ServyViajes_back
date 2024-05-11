<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationRooms extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reservation_id',
        'room_id',
        'room_type_name',
        'adults_quantity',
        'minor_quantity',
        'estatus'
    ];

    public function reservationRoomsDetails()
    {
        return $this->hasMany(ReservationRoomsDetails::class, 'reservation_room_id');
    }
}
