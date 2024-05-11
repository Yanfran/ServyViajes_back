<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
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

    //atributos agregados 
    protected $appends = ['tiene_eventos_activos'];

    public function avalible_categories()
    {
        return $this->hasMany(AvailableCategories::class, 'category_id');
    }

    //attributes
    public function getTieneEventosActivosAttribute()
    {
        return $this->avalible_categories()->where('estatus', 1)->exists();
    }

}
