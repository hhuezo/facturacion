<?php

namespace App\Models\facturacion;

use App\Models\catalogo\EstadoFactura;
use App\Models\catalogo\FormaPago;
use App\Models\general\Cliente;
use App\Models\general\Empresa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumidorFinal extends Model
{
    use HasFactory;

    protected $table = 'facturacion_consumidor_final';

    protected $fillable = [
        'fecha',
        'cliente_id',
        'direccion',
        'telefono',
        'correo',
        'numero_factura',
        'forma_pago_id',
        'retener_iva',
        'retener_renta',
        'observacion',
        'users_id',
        'estado_factura_id',
        'empresa_id',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    // Relaciones
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function formaPago()
    {
        return $this->belongsTo(FormaPago::class, 'forma_pago_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function estadoFactura()
    {
        return $this->belongsTo(EstadoFactura::class, 'estado_factura_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
}
