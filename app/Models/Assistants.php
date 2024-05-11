<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assistants extends Model
{
    use HasFactory;
    // use HasApiTokens, HasFactory, Notifiable;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'codigo_beca',
        'categoria_id',
        'grado_academico',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'correo_electronico',        
        'telefono',        
        'comentario',        
        'pais_id',
        'estado',        
        'ciudad',        
        'especialidad',        
        'institucion',  
        'evento_id',
        'facturacion',        
        'rfc',        
        'nombre_fiscal',        
        'correo_facturacion',        
        'codigo_postal',        
        'regimen_fiscal_id',
        'cfdi_id',     
        'comentario_facturacion',           
        'estatus',        
        'monto_total',    
        'tipo_pago_id',
        'estatus_de_pago',
        'user_id',
        'descuento', 
        'academic_grade_id'                   
    ];


    public function constancy()
    {
        return $this->hasMany(Constancy::class, 'assistants_id');
    }  

    public function payment_proofs()
    {
        return $this->hasMany(PaymentProofs::class, 'assistants_id');
    }  
        
    public function event()
    {
        return $this->belongsTo(Events::class, 'evento_id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'categoria_id');
    }

    public function payment_types()
    {
        return $this->belongsTo(PaymentTypes::class, 'tipo_pago_id');
    }

    public function tax_regimes()
    {
        return $this->belongsTo(TaxRegimes::class, 'regimen_fiscal_id');
    }

    public function cfdi()
    {
        return $this->belongsTo(Cfdi::class, 'cfdi_id');
    }

    public function academic_grade()
    {
        return $this->belongsTo(AcademicGrades::class, 'academic_grade_id');
    }
    
}
