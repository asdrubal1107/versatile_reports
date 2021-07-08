<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Actividad;
use App\Models\Obligacion;

class ActividadController extends Controller
{
    public function view_list(){
        return view('modulos.parametrizaciones.gestion_actividades.listar_actividades');
    }

    public function view_create(){
        $obligaciones = Obligacion::all();
        return view('modulos.parametrizaciones.gestion_actividades.crear_actividades', compact("obligaciones"));
    }
    
    public function view_edit($id){
        $actividad = Actividad::find($id);
        $obligaciones = Obligacion::all();
        return view('modulos.parametrizaciones.gestion_actividades.editar_actividades', compact("actividad", "obligaciones"));
    }

    public function list(){
        if(request()->ajax()){
            $actividades = Actividad::join('obligaciones', 'obligaciones.id_obligacion', '=', 'actividades.id_obligacion')
                ->select('actividades.*', 'obligaciones.detalle as detalle_obligacion')->get();
            return DataTables::of($actividades)
                ->addColumn('Opciones', function ($actividad) {
                    return '<a style="width: 30px; height: 30px;" href="/parametrizaciones/actividades/editar/'.$actividad->id_actividad.'" class="btn btn-sm btn-versatile_reports"><i class="ft-edit"></i></a>';
                })
                ->rawColumns(['Opciones'])
                ->make(true);
        }
        return redirect()->route('dashboard');
    }

    public function save(Request $request){
        $this->rules($request);
        try {
            Actividad::create([
                'detalle' => $request->detalle,
                'id_obligacion' => $request->id_obligacion
            ]);
            return redirect()->route('listar_actividades')->withSuccess('Se creo con éxito');
        } catch (Exception $e) {
            return redirect()->route('listar_actividades')->withErrors('Ocurrio un error\nError: '.$e->getMessage());
        }
    }

    public function update(Request $request){
        $this->rules($request);
        $actividad = Actividad::find($request->id_actividad);
        if ($actividad == null) {
            return redirect()->route('listar_actividades')->withErrors('No se encontro la actividad');
        }
        try {
            $actividad->update([
                'detalle' => $request->detalle,
                'id_obligacion' => $request->id_obligacion
            ]);
            return redirect()->route('listar_actividades')->withSuccess('Se modifico con éxito');
        } catch (Exception $e) {
            return redirect()->route('listar_actividades')->withErrors('Ocurrio un error\nError: '.$e->getMessage());
        }
    }

    public function rules(Request $request){
        $request->validate([
            'detalle' => 'required',
            'id_obligacion' => 'required|exists:obligaciones,id_obligacion'
        ]);
    }
}
