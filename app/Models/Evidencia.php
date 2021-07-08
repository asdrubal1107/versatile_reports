<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    use HasFactory;
    protected $primaryKey = "id_evidencia";
    public $timestamps = false;
    protected $fillable = [
        'detalle',
        'id_actividad'
    ];
}
