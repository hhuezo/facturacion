<?php

namespace App\Models\hacienda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $table = 'mh_municipio';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'mh_departamento_id',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
}
