<?php

namespace App\Models\catalogo;

use App\Models\general\Cliente;
use App\Models\general\Empresa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoContribuyente extends Model
{
    use HasFactory;

    protected $table = 'tipo_contribuyente';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'descripcion',
        'activo'
    ];

    // Relación inversa de empresa
    public function empresas()
    {
        return $this->hasMany(Empresa::class, 'tipo_contribuyente_id');
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'tipo_contribuyente_id');
    }
}
