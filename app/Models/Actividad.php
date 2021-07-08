<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;
    protected $primaryKey = "id_actividad";
    protected $table = "actividades";
    public $timestamps = false;
    protected $fillable = [
        'detalle',
        'id_obligacion'
    ];
}
