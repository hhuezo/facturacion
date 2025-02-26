<?php

namespace App\Models\general;

use App\Models\catalogo\TipoIva;
use App\Models\catalogo\TipoProducto;
use App\Models\catalogo\UnidadMedida;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

        protected $table = 'producto';

        protected $primaryKey = 'id';

        protected $fillable = [
            'barra',
            'codigo',
            'descripcion',
            'tipo_iva_id',
            'tipo_producto_id',
            'unidad_medida_id',
            'empresa_id',
            'activo',
        ];


        public function tipoIva()
        {
            return $this->belongsTo(TipoIva::class, 'tipo_iva_id');
        }


        public function tipoProducto()
        {
            return $this->belongsTo(TipoProducto::class, 'tipo_producto_id');
        }

        public function unidadMedida()
        {
            return $this->belongsTo(UnidadMedida::class, 'unidad_medida_id');
        }


        public function empresa()
        {
            return $this->belongsTo(Empresa::class, 'empresa_id');
        }
}
