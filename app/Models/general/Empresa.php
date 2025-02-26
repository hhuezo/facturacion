<?php

namespace App\Models\general;

use App\Models\catalogo\TipoContribuyente;
use App\Models\catalogo\TipoNegocio;
use App\Models\catalogo\TipoProducto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresa';

    public $timestamps = true;

    protected $fillable = [
        'razon_social',
        'Nit',
        'nombre_comercial',
        'direccion',
        'correo',
        'telefono',
        'tipo_contribuyente_id',
        'tipo_negocio_id',
        'agente_retencion',
        'tipo_producto_id',
        'nrc',
        'logo',
    ];

    // Definir las relaciones con otras tablas
    public function tipoContribuyente()
    {
        return $this->belongsTo(TipoContribuyente::class, 'tipo_contribuyente_id');
    }

    public function tipoNegocio()
    {
        return $this->belongsTo(TipoNegocio::class, 'tipo_negocio_id');
    }

    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class, 'tipo_producto_id');
    }


    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'empresa_id');
    }


    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
