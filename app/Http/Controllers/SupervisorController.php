<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use DataTables;
use Exception;
use Illuminate\Http\Request;

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
        return view('modulos.parametrizaciones.gestion_supervisores.editar_supervisor', compact('supervisor'));
    }


    public function list(){
        $supervisores = Supervisor::all();

        return DataTables::of($supervisores)
            ->editColumn('estado', function($supervisor){
                return $supervisor->estado == 1 ? "Activo" : "Inactivo";
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
            ->rawColumns(['Opciones'])
            ->make(true);
    }

    public function save(Request $request){

        $this->validations($request);

        try {
            Supervisor::create([
                'documento' => $request->documento,
                'nombre' => $request->nombre,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'cargo' => $request->cargo
            ]);

            return redirect()->route('listar_supervisores')->withSuccess('Se creo con éxito');
        } catch (Exception $e) {
            return redirect()->route('listar_supervisores')->withErrors('Ocurrio un error\nError: '.$e->getMessage());
        }
    }


    public function update(Request $request){

        $this->validations($request);

        try {
            $supervisor = Supervisor::find($request->id_supervisor);

            if($supervisor == null) return redirect()->route('listar_supervisores')->withErrors('No se encontro el supervisor');

            $supervisor->update([
                'documento' => $request->documento,
                'nombre' => $request->nombre,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'cargo' => $request->cargo
            ]);

            return redirect()->route('listar_supervisores')->withSuccess('Se modifico con éxito');
        } catch (Exception $e) {
            return redirect()->route('listar_supervisores')->withErrors('Ocurrio un error\nError: '.$e->getMessage());
        }
    }

    public function update_state($id, $estado){
        $supervisor = Supervisor::find($id);

        if ($supervisor == null) {
            return redirect()->route('listar_supervisores')->withErrors('No se encontro el supervisor');
        }

        if ($estado != 1 && $estado != 0) {
            return redirect()->route('listar_supervisores')->withErrors('El estado no se pudo actualizar');
        }

        try{
            $supervisor->update(['estado' => $estado]);
            return redirect()->route('listar_supervisores')->withSuccess('Se modifico el estado del supervisor');
        }catch(Exception $e){
            return redirect()->route('listar_supervisores')->withErrors('Ocurrio un error\nError: '.$e->getMessage());
        }
    }

    public function validations(Request $request){
        $request->validate([
            'documento' => 'required|numeric|digits_between:6,14',
            'nombre' => 'required|string|min:3|max:40',
            'primer_apellido' => 'required|string|min:3|max:30',
            'segundo_apellido' => 'nullable|string|min:3|max:30',
            'cargo' => 'required|string|min:3|max:50',
            'estado' => 'in:1,0'
        ]);
    }
}
