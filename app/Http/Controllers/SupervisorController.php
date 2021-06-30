<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use App\Models\User;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SupervisorController extends Controller
{
    public function view_list(){
        return view('modulos.parametrizaciones.gestion_supervisores.listar_supervisores');
    }

    public function view_create(){
        return view('modulos.parametrizaciones.gestion_supervisores.crear_supervisor');
    }
    
    public function view_edit($id){
        $supervisor = Supervisor::find($id);
        return view('modulos.parametrizaciones.gestion_supervisores.editar_supervisor', compact("supervisor"));
    }

    public function list(){
        if(request()->ajax()){
            $supervisores = Supervisor::all();

            return DataTables::of($supervisores)
                ->editColumn('estado', function($supervisor){
                    if ($supervisor->estado == 1) {
                        return '<div class="badge badge-success">Activo</div>';
                    }
                    return '<div class="badge badge-danger">Inactivo</div>';
                })
                ->addColumn('Opciones', function ($supervisor) {
                    if ($supervisor->estado == 1) {
                        $btnEstado = '<a style="width: 30px; height: 30px;" href="/parametrizaciones/supervisores/cambiar/estado/'.$supervisor->id_supervisor.'/0" class="btn btn-sm btn-danger btn-estados"><i class="ft-alert-octagon"></i></a>';
                    }else{
                        $btnEstado = '<a style="width: 30px; height: 30px;" href="/parametrizaciones/supervisores/cambiar/estado/'.$supervisor->id_supervisor.'/1" class="btn btn-sm btn-success btn-estados"><i class="ft-check-square"></i></a>';
                    }
                    $btnEditar = '<a style="width: 30px; height: 30px;" href="/parametrizaciones/supervisores/editar/'.$supervisor->id_supervisor.'" class="btn btn-sm btn-versatile_reports"><i class="ft-edit"></i></a>';
                    return $btnEditar.'  '.$btnEstado;
                })
                ->rawColumns(['Opciones', 'estado'])
                ->make(true);
        }
        return redirect()->route('dashboard');
    }

    public function save(Request $request){

        $request->validate([
            'tipo_documento' => 'required',
            'documento' => 'required|numeric|digits_between:6,14|unique:supervisores,documento|unique:usuarios,documento',
            'nombre' => 'required|string|min:3|max:40',
            'primer_apellido' => 'required|string|min:3|max:30',
            'segundo_apellido' => 'nullable|string|min:3|max:30',
            'cargo' => 'required|string|min:3|max:50',
            'password' => 'required|string|min:8|max:20',
            'correo' => 'required|email|unique:supervisores,correo|unique:usuarios,email'
        ]);

        try {
            DB::beginTransaction();
            Supervisor::create([
                'tipo_documento' => $request->tipo_documento,
                'documento' => $request->documento,
                'nombre' => $request->nombre,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'correo' => $request->correo,
                'cargo' => $request->cargo
            ]);

            User::create([
                'tipo_documento' => $request->tipo_documento,
                'documento' => $request->documento,
                'password' => Hash::make($request->password),
                'email' => $request->correo,
                'id_rol' => '2'
            ]);
            DB::commit();
            return redirect()->route('listar_supervisores')->withSuccess('Se creo con éxito');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('listar_supervisores')->withErrors('Ocurrio un error\nError: '.$e->getMessage());
        }
    }


    public function update(Request $request){
        if($request->documento_anterior != $request->documento){
            $request->validate([
                'documento' => 'required|numeric|digits_between:6,14|unique:supervisores,documento|unique:usuarios,documento'
            ]);
        }
        if ($request->correo_anterior == $request->correo) {
            $request->validate([
                'tipo_documento' => 'required',
                'nombre' => 'required|string|min:3|max:40',
                'primer_apellido' => 'required|string|min:3|max:30',
                'segundo_apellido' => 'nullable|string|min:3|max:30',
                'cargo' => 'required|string|min:3|max:50',
                'password' => 'nullable|string|min:8|max:20',
                'correo' => 'required|email'
            ]);
        }else{
            $request->validate([
                'tipo_documento' => 'required',
                'nombre' => 'required|string|min:3|max:40',
                'primer_apellido' => 'required|string|min:3|max:30',
                'segundo_apellido' => 'nullable|string|min:3|max:30',
                'cargo' => 'required|string|min:3|max:50',
                'password' => 'nullable|string|min:8|max:20',
                'correo' => 'required|email|unique:supervisores,correo|unique:usuarios,email'
            ]);
        }
        try {
            DB::beginTransaction();
            $supervisor = Supervisor::find($request->id_supervisor);
            $usuario = User::select('*')->where('documento', '=', ''.$supervisor->documento.'')->take(1)->get();

            if($supervisor == null) return redirect()->route('listar_supervisores')->withErrors('No se encontro el supervisor');

            $supervisor->update([
                'tipo_documento' => $request->tipo_documento,
                'documento' => $request->documento,
                'nombre' => $request->nombre,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'correo' => $request->correo,
                'cargo' => $request->cargo
            ]);

            if ($request->password != null) {
                $usuario[0]->update([
                    'tipo_documento' => $request->tipo_documento,
                    'documento' => $request->documento,
                    'password' => $request->password,
                    'email' => $request->correo
                ]);
                DB::commit();
                return redirect()->route('listar_supervisores')->withSuccess('Se modifico con éxito');
            }
            $usuario[0]->update([
                'tipo_documento' => $request->tipo_documento,
                'documento' => $request->documento,
                'email' => $request->correo
            ]);
            DB::commit();
            return redirect()->route('listar_supervisores')->withSuccess('Se modifico con éxito');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('listar_supervisores')->withErrors('Ocurrio un error\nError: '.$e->getMessage());
        }
    }

    public function update_state($id, $estado){
        $supervisor = Supervisor::find($id);
        $usuario = User::select('id_usuario')->where('documento', '=', ''.$supervisor->documento.'')->take(1)->get();

        if ($supervisor == null) {
            return redirect()->route('listar_supervisores')->withErrors('No se encontro el supervisor');
        }

        if ($estado != 1 && $estado != 0) {
            return redirect()->route('listar_supervisores')->withErrors('El estado no se pudo actualizar');
        }

        try{
            DB::beginTransaction();
            $supervisor->update(['estado' => $estado]);
            $usuario[0]->update(['estado' => $estado]);
            DB::commit();
            return redirect()->route('listar_supervisores')->withSuccess('Se modifico el estado del supervisor y del usuario asociado a este supervisor');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('listar_supervisores')->withErrors('Ocurrio un error\nError: '.$e->getMessage());
        }
    }
}
