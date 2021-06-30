<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use DataTables;

class RolController extends Controller
{
    public function view_list(){
        return view('modulos.parametrizaciones.gestion_roles.listar_roles');
    }

    public function list(){
        if(request()->ajax()){
            $roles = Rol::all();
            return DataTables::of($roles)
                ->make(true);
        }
        return redirect()->route('dashboard');
    }
}
