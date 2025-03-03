<?php

namespace App\Models\general;

use App\Models\catalogo\TipoContribuyente;
use App\Models\catalogo\TipoNegocio;
use App\Models\catalogo\TipoProducto;
use App\Models\hacienda\ActividadEconomica;
use App\Models\hacienda\TipoItem;
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
        'nit',
        'nombre_comercial',
        'numero_iva',
        'direccion',
        'correo',
        'telefono',
        'tipo_contribuyente_id',
        'nrc',
        'agente_retencion',
        'mh_actividad_economica_id',
        'mh_tipo_item_id',
        'ambiente_id',
        'clave_publica',
        'clave_privada',
        'password_api',
        'url_firmador',
        'logo'
    ];

    // Definir las relaciones con otras tablas
    public function tipoContribuyente()
    {
        return $this->belongsTo(TipoContribuyente::class, 'tipo_contribuyente_id');
    }

    public function actividadEconomica()
    {
        return $this->belongsTo(ActividadEconomica::class, 'mh_actividad_economica_id');
    }

    public function tipoItem()
    {
        return $this->belongsTo(TipoItem::class, 'mh_tipo_item_id');
    }


    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'empresa_id');
    }


    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function sucursales()
    {
        return $this->hasMany(EmpresaSucursal::class, 'empresa_id');
    }
}
