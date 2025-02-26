<?php

namespace App\Models\catalogo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamento';

    protected $fillable = [
        'nombre',
        'codigo',
    ];

    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'departamento_id');
    }
}
