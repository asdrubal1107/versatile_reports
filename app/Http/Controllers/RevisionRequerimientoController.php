<?php

namespace App\Http\Controllers;

use App\Models\Requerimiento;
use App\Models\RespuestaRequerimiento;
use Illuminate\Http\Request;
use DataTables;
use Exception;

class RevisionRequerimientoController extends Controller
{
    public function view_list(){
        return view('modulos.revision_requerimientos.listar_rev_requerimientos');
    }

    public function list(){
        if(request()->ajax()){
            $requerimientos = Requerimiento::all();
            return DataTables::of($requerimientos)
                ->addColumn('Opciones', function($requerimiento){
                    $opcion = '<a href="/revision/requerimientos/detalles/'.$requerimiento->id_requerimiento.'" class="btn btn-versatile_reports"><i class="ft-eye"></i></a>';
                    return $opcion;
                })
                ->rawColumns(['Opciones'])
                ->make(true);
        }
        return redirect()->route('dashboard');
    }

    public function view_list_details($id){
        $requerimiento = Requerimiento::find($id);
        return view('modulos.revision_requerimientos.listar_rev_detalles', compact("requerimiento"));
    }

    public function list_details($id){
        if (request()->ajax()) {
            $respuestas_requerimientos = RespuestaRequerimiento::join('contratos', 'contratos.id_contrato', '=', 'respuestas_requerimientos.id_contrato')
            ->join('contratistas', 'contratistas.id_contratista', '=', 'contratos.id_contratista')
            ->select('respuestas_requerimientos.*', 'contratos.numero_contrato', 'contratistas.documento')
            ->where('id_requerimiento', '=', ''.$id.'')->get();
            return DataTables::of($respuestas_requerimientos)
                ->editColumn('estado', function($respuesta_requerimiento){
                    if ($respuesta_requerimiento->estado == 0) {
                        $estado = '<div class="badge badge-danger">No aprobado</div>';
                    }else{
                        $estado = '<div class="badge badge-success">Aprobado</div>';
                    }
                    return $estado;
                })
                ->addColumn('Opciones', function($respuesta_requerimiento){
                    $opcion = '<a href="/revision/requerimientos/descargar/archivo/'.$respuesta_requerimiento->nombre.'" class="btn btn-versatile_reports"><i class="ft-download"></i></a>';
                    if ($respuesta_requerimiento->estado == 0) {
                        $estado = '<a href="/revision/requerimientos/archivo/cambiar/estado/'.$respuesta_requerimiento->id_respuesta_requerimiento.'/1" class="btn btn-estados btn-success"><i class="ft-check"></i></a>';
                    }else{
                        $estado = '<a href="/revision/requerimientos/archivo/cambiar/estado/'.$respuesta_requerimiento->id_respuesta_requerimiento.'/0" class="btn btn-estados btn-danger"><i class="ft-trash"></i></a>';
                    }
                    return $opcion . ' ' . $estado;
                })
                ->rawColumns(['Opciones', 'estado'])
                ->make(true);
        }
        return redirect()->route('dashboard');
    }

    public function download_archive($nombre){
        $archivo = public_path('uploads/archivos/'.$nombre.'');
        return response()->download($archivo);
    }

    public function update_state($id, $estado){
        $respuesta_requerimiento = RespuestaRequerimiento::find($id);
        if ($respuesta_requerimiento == null) {
            return back()->withErrors('La respuesta al requerimiento no existe');
        }
        try {
            $respuesta_requerimiento->update([
                'estado' => $estado
            ]);
            if ($estado == 0) {
                return back()->withSuccess('La respuesta fue desaprobada');
            }else{
                return back()->withSuccess('Se aprobo la respuesta');
            }
        } catch (Exception $e) {
            return back()->withSuccess('Ocurrio un error: '.$e->getMessage());
        }
    }
}
