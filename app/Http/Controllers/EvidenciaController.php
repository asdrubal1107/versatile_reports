<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Evidencia;
use App\Models\Actividad;

class EvidenciaController extends Controller
{
    public function view_list(){
        return view('modulos.parametrizaciones.gestion_evidencias.listar_evidencias');
    }

    public function view_create(){
        $actividades = Actividad::all();
        return view('modulos.parametrizaciones.gestion_evidencias.crear_evidencias', compact("actividades"));
    }
    
    public function view_edit($id){
        $evidencia = Evidencia::find($id);
        $actividades = Actividad::all();
        return view('modulos.parametrizaciones.gestion_evidencias.editar_evidencias', compact("evidencia", "actividades"));
    }

    public function list(){
        if(request()->ajax()){
            $evidencias = Evidencia::join('actividades', 'actividades.id_actividad', '=', 'evidencias.id_actividad')
                ->select('evidencias.*', 'actividades.detalle as detalle_actividad')->get();
            return DataTables::of($evidencias)
                ->addColumn('Opciones', function ($evidencia) {
                    return '<a style="width: 30px; height: 30px;" href="/parametrizaciones/evidencias/editar/'.$evidencia->id_evidencia.'" class="btn btn-sm btn-versatile_reports"><i class="ft-edit"></i></a>';
                })
                ->rawColumns(['Opciones'])
                ->make(true);
        }
        return redirect()->route('dashboard');
    }

    public function save(Request $request){
        $this->rules($request);
        try {
            Evidencia::create([
                'detalle' => $request->detalle,
                'id_actividad' => $request->id_actividad
            ]);
            return redirect()->route('listar_evidencias')->withSuccess('Se creo con éxito');
        } catch (Exception $e) {
            return redirect()->route('listar_evidencias')->withErrors('Ocurrio un error\nError: '.$e->getMessage());
        }
    }

    public function update(Request $request){
        $this->rules($request);
        $evidencia = Evidencia::find($request->id_evidencia);
        if ($evidencia == null) {
            return redirect()->route('listar_evidencias')->withErrors('No se encontro la evidencia');
        }
        try {
            $evidencia->update([
                'detalle' => $request->detalle,
                'id_actividad' => $request->id_actividad
            ]);
            return redirect()->route('listar_evidencias')->withSuccess('Se modifico con éxito');
        } catch (Exception $e) {
            return redirect()->route('listar_evidencias')->withErrors('Ocurrio un error\nError: '.$e->getMessage());
        }
    }

    public function rules(Request $request){
        $request->validate([
            'detalle' => 'required',
            'id_actividad' => 'required|exists:actividades,id_actividad'
        ]);
    }
}
