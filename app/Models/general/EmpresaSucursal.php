<?php

namespace App\Models\general;

use App\Models\hacienda\Departamento;
use App\Models\hacienda\Municipio;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaSucursal extends Model
{
    use HasFactory;

    protected $table = 'empresa_sucursal';

    protected $fillable = [
        'codigo',
        'empresa_id',
        'responsable',
        'telefono',
        'correo',
        'mh_departamento_id',
        'mh_municipio_id',
        'direccion',
        'activo',
        'user_id',
    ];

    public $timestamps = true;


    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'mh_departamento_id', 'id');
    }


    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'mh_municipio_id', 'id');
    }
}
