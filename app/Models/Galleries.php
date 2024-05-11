<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galleries extends Model
{
    use HasFactory;
    // use HasApiTokens, HasFactory, Notifiable;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [        
        'ruta',               
        'estatus',        
    ];

    public function hotels()
    {
        return $this->belongsTo(Hotels::class, 'gallery_id');
    }
}
