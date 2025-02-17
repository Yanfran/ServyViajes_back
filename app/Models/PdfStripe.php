<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfStripe extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar de manera masiva.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'file',
        'lang_o',
        'lang_t',
        'number_page',
        'certification',
        'apostille',
        'cupon',
        'email_stripe',
        'transaction_stripe',
        'total',
    ];

    protected $table = 'pdf_stripe';
}
