<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicGrades extends Model
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
        'events_id',      
    ];


    public function event()
    {
        return $this->belongsTo(Events::class, 'events_id');
    }    
    
    public function assistants()
    {
        return $this->hasMany(assistants::class, 'academic_grade_id');
    }
}
