<?php

namespace App\Models\catalogo;

use App\Models\general\Empresa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    use HasFactory;

    protected $table = 'tipo_producto';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'descripcion',
        'activo'
    ];

    // Relación inversa de empresa
    public function empresas()
    {
        return $this->hasMany(Empresa::class, 'tipo_producto_id');
    }

}
