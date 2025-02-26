<?php

namespace App\Models\general;

use App\Models\catalogo\OperadoraTelefono;
use App\Models\catalogo\TipoCliente;
use App\Models\catalogo\TipoContribuyente;
use App\Models\catalogo\TipoIdentificacion;
use App\Models\facturacion\ConsumidorFinal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'codigo',
        'razon_social',
        'nombre_comercial',
        'tipo_identificacion_id',
        'numero_documento',
        'nrc',
        'genero',
        'ciudad',
        'direccion',
        'correo',
        'operadora_telefono_id',
        'telefono',
        'tipo_contribuyente_id',
        'tipo_cliente_id',
        'activo',
        'empresa_id',
    ];


    public function tipoIdentificacion()
    {
        return $this->belongsTo(TipoIdentificacion::class, 'tipo_identificacion_id');
    }


    public function operadoraTelefono()
    {
        return $this->belongsTo(OperadoraTelefono::class, 'operadora_telefono_id');
    }


    public function tipoContribuyente()
    {
        return $this->belongsTo(TipoContribuyente::class, 'tipo_contribuyente_id');
    }


    public function tipoCliente()
    {
        return $this->belongsTo(TipoCliente::class, 'tipo_cliente_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

     public function facturasConsumidorFinal()
     {
         return $this->hasMany(ConsumidorFinal::class, 'cliente_id');
     }
}
