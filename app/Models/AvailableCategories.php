<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableCategories extends Model
{
    use HasFactory;
    // use HasApiTokens, HasFactory, Notifiable;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [        
        'category_id',
        'costo',        
        'estatus',        

    ];


    public function event()
    {
        return $this->belongsTo(Events::class, 'events_id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    
}
