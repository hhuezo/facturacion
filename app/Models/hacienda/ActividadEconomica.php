<?php

namespace App\Models\hacienda;

use App\Models\general\Empresa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadEconomica extends Model
{
    use HasFactory;

    protected $table = 'mh_actividad_economica';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'nombre',
        'activo'
    ];

     // Relación inversa de empresa
     public function empresas()
     {
         return $this->hasMany(Empresa::class, 'mh_actividad_economica_id');
     }
}
