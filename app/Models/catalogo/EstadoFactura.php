<?php

namespace App\Models\catalogo;

use App\Models\facturacion\ConsumidorFinal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoFactura extends Model
{
    use HasFactory;

    protected $table = 'estado_factura';

    protected $fillable = [
        'descripcion'
    ];

    public $timestamps = false;

    // Relación con facturación consumidor final
    public function facturasConsumidorFinal()
    {
        return $this->hasMany(ConsumidorFinal::class, 'estado_factura_id');
    }
}
