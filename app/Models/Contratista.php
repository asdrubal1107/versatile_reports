<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratista extends Model
{
    use HasFactory;

    protected $primaryKey = "id_contratista";
    protected $fillable = [
        'tipo_documento',
        'documento',
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'correo',
        'correo_sena',
        'celular_uno',
        'celular_dos',
        'firma',
        'estado',
        'id_municipio'
    ];
}
