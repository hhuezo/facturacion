<?php

namespace App\Models\hacienda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'mh_departamento';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'nombre',
    ];

    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'mh_departamento_id', 'id');
    }
}
