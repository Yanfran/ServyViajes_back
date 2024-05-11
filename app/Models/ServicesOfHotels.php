<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesOfHotels extends Model
{
    use HasFactory;
    // use HasApiTokens, HasFactory, Notifiable;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'descripcion',
        'estatus',
    ];


    public function hotels()
    {
        return $this->belongsTo(Hotels::class, 'hotel_id');
    }
    
}
