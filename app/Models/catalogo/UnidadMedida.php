<?php

namespace App\Models\catalogo;

use App\Models\general\Producto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    use HasFactory;


    protected $table = 'unidad_medida';
    protected $primaryKey = 'id';
    protected $fillable = [
        'descripcion', 'activo', 'empresa_id'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'unidad_medida_id');
    }
}
