<?php

namespace App\Http\Controllers;

use App\Models\Contratista;
use App\Models\Supervisor;
use App\Models\User;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function view_list(){
        return view('modulos.gestion_usuarios.listar_usuarios');
    }

    public function view_ajustes($id){
        $usuario = User::find($id);
        return view('modulos.gestion_usuarios.ajustes_usuarios', compact("usuario"));
    }

    public function list(){
        if(request()->ajax()){
            $usuarios = User::join('roles', 'roles.id_rol', '=', 'usuarios.id_rol')
            ->select('usuarios.*', 'roles.nombre as nombre_rol');
            return DataTables::of($usuarios)
                ->editColumn('estado', function($usuario){
                    if ($usuario->estado == 1) {
                        return '<div class="badge badge-pill badge-success">Activo</div>';
                    }
                    return '<div class="badge badge-pill badge-danger">Inactivo</div>';
                })
                ->rawColumns(['estado'])
                ->make(true);
        }
        return redirect()->route('dashboard');
    }

    public function ajustes_usuarios(Request $request){
        if ($request->contraseña == null) {
            return back()->withErrors('No hubo cambios');
        }
        $request->validate([
            'contraseña' => 'required|confirmed|min:8|max:20'
        ]);
        $usuario = User::find($request->id_usuario);
        try {
            $usuario->update([
                'password' => Hash::make($request->contraseña)
            ]);
            return back()->withSuccess('Contraseña actualizada');
        } catch (Exception $e) {
            return back()->withErrors('Ocurrio un error: '.$e->getMessage());
        }
    }
}
