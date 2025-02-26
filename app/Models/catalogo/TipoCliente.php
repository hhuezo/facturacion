<?php

namespace App\Models\catalogo;

use App\Models\general\Cliente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model
{
    use HasFactory;


    protected $table = 'tipo_cliente';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'descripcion',
        'activo'
    ];


    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'tipo_cliente_id');
    }
}
