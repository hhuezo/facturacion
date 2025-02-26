<?php

namespace App\Models\catalogo;

use App\Models\facturacion\ConsumidorFinal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
    use HasFactory;

    protected $table = 'forma_pago';

    protected $fillable = [
        'descripcion',
        'activo'
    ];

    public $timestamps = false;

    // Relación con facturación consumidor final
    public function facturasConsumidorFinal()
    {
        return $this->hasMany(ConsumidorFinal::class, 'forma_pago_id');
    }
}
