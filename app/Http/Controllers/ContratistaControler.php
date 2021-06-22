<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContratistaControler extends Controller
{
    public function view_list(){
        return view('modulos.gestion_contratistas.listar_contratistas');
    }
}
