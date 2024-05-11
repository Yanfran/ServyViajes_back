<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constancy extends Model
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
        'estatus',
        'assistants_id',               
    ];

    public function assistants()
    {
        return $this->belongsTo(Assistants::class, 'assistants_id');
    }    
}
