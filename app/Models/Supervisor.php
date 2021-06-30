<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;

    protected $table = "supervisores";
    protected $primaryKey = "id_supervisor";
    protected $fillable = [
        'documento',
        'tipo_documento',
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'correo',
        'estado',
        'cargo'
    ];
}
