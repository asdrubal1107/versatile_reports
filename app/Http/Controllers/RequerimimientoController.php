<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Proceso;
use App\Models\Requerimiento;
use App\Models\TipoRequerimiento;
use Carbon\Carbon;
use Exception;

class RequerimimientoController extends Controller
{
    public function view_list(){
        return view('modulos.gestion_requerimientos.listar_requerimientos');
    }

    public function view_create(){
        $tipos_requerimientos = TipoRequerimiento::all();
        $procesos = Proceso::all();
        return view("modulos.gestion_requerimientos.crear_requerimiento", compact("tipos_requerimientos", "procesos"));
    }

    public function view_edit($id){
        $requerimiento = Requerimiento::find($id);
        return view("modulos.gestion_requerimientos.editar_requerimiento", compact("requerimiento"));
    }

    public function list(){
        $requerimientos = Requerimiento::join('procesos', 'procesos.id_proceso', '=', 'requerimientos.id_proceso')
        ->select('requerimientos.*', 'procesos.nombre as nombre_proceso')->get();
        return DataTables::of($requerimientos)
        ->editColumn('estado', function($requerimiento){
            if ($requerimiento->estado == 1) {
                return '<div class="badge badge-pill badge-success">Requerimiento activo</div>';
            }
            else{
                return '<div class="badge badge-pill badge-danger">Requerimiento inactivo</div>';
            }
        })
        ->addColumn('Opciones', function ($requerimiento) {
            return '<a style="width: 70px;" href="/requerimientos/editar/'.$requerimiento->id_requerimiento.'" class="btn btn-sm btn-versatile_reports"><i class="ft-edit"></i> Editar</a>';
        })
        ->rawColumns(['Opciones', 'estado'])
        ->make(true);
    }

    public function save(Request $request){
        $request->validate([
            'nombre' => 'required|string|min:3|max:100',
            'detalle' => 'required|string|min:3|max:255',
            'fecha_finalizacion' => 'required|date',
            'id_proceso' => 'required|numeric|exists:procesos,id_proceso',
            'id_tipo_requerimiento' => 'required|numeric|exists:tipos_requerimientos,id_tipo_requerimiento'
        ]);
        try {
            //Fecha creacion automatica
            $fecha_creacion = Carbon::now();
            $fecha_creacion = $fecha_creacion->format('Y-m-d');
            //Formateo fecha finalizacion
            $fecha_finalizacion = $request->fecha_finalizacion;
            $fecha_finalizacion = date("Y-m-d", strtotime($fecha_finalizacion));
            if($fecha_creacion > $fecha_finalizacion){
                return redirect()->route('listar_requerimientos')->withErrors('No se pudo crear el requerimiento, la fecha de finalizacion introducida era menor a la fecha actual, intenta de nuevo.');
            }
            Requerimiento::create([
                'nombre' => $request->nombre,
                'detalle' => $request->detalle,
                'fecha_creacion' => $fecha_creacion,
                'fecha_finalizacion' => $fecha_finalizacion,
                'id_proceso' => $request->id_proceso,
                'id_tipo_requerimiento' => $request->id_tipo_requerimiento
            ]);
            return redirect()->route('listar_requerimientos')->withSuccess('Se creo con exito');
        } catch (Exception $e) {
            return redirect()->route('listar_requerimientos')->withErrors('Ocurrio un error: '.$e->getMessage());
        }
    }

    public function update(Request $request){
        $request->validate([
            'nombre' => 'required|string|min:3|max:100',
            'detalle' => 'required|string|min:3|max:255',
            'fecha_finalizacion' => 'required|date'
        ]);
        try {
            $requerimiento = Requerimiento::find($request->id_requerimiento);
            $fecha_finalizacion = $request->fecha_finalizacion;
            $fecha_finalizacion = date("Y-m-d", strtotime($fecha_finalizacion));
            if($requerimiento->fecha_creacion > $fecha_finalizacion){
                return redirect()->route('listar_requerimientos')->withErrors('No se pudo crear el requerimiento, la fecha de finalizacion introducida era menor a la fecha actual, intenta de nuevo.');
            }
            $requerimiento->update([
                'nombre' => $request->nombre,
                'detalle' => $request->detalle,
                'fecha_finalizacion' => $fecha_finalizacion,
            ]);
            return redirect()->route('listar_requerimientos')->withSuccess('Se modifico con exito');
        } catch (Exception $e) {
            return redirect()->route('listar_requerimientos')->withErrors('Ocurrio un error: '.$e->getMessage());
        }
    }
}
