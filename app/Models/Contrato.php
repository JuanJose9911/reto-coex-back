<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $table = 'contratos';

    protected $fillable = [
        'sueldo',
        'duracion',
        'tipo_contrato_id'
    ];


    public function tipo_contrato()
    {
        return $this->hasOne('App\Models\TipoContrato');
    }

    public function empleado()
    {
        return $this->hasOne('App\Models\Empleado');
    }
}
