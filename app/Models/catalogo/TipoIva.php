<?php

namespace App\Models\catalogo;

use App\Models\general\Producto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoIva extends Model
{
    use HasFactory;

       // Define the table name
       protected $table = 'tipo_iva';

       // Define the primary key
       protected $primaryKey = 'id';

       protected $fillable = [
           'descripcion',
       ];


       public function productos()
       {
           return $this->hasMany(Producto::class, 'tipo_iva_id');
       }
}
