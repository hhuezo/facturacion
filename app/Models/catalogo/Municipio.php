<?php

namespace App\Models\catalogo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $table = 'municipio';

    protected $fillable = [
        'nombre',
        'departamento_id',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

     // Relación: Un Municipio tiene muchos Distritos
     public function distritos()
     {
         return $this->hasMany(Distrito::class, 'municipio_id');
     }
}
