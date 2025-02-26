<?php

namespace App\Models\catalogo;

use App\Models\general\Cliente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperadoraTelefono extends Model
{
    use HasFactory;

    protected $table = 'operadora_telefono';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'descripcion',
        'activo'
    ];

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'operadora_telefono_id');
    }
}
