<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $fillable = [
        'documento',
        'nombre',
        'apellidos',
        'telefono',
        'direccion',
        'contrato_id'
    ];

    public function contrato()
    {
        return $this->hasOne('App\Models\Contrato');
    }
}
