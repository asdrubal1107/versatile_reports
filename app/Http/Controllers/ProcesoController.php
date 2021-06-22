<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use DataTables;
use App\Models\Proceso;

class ProcesoController extends Controller
{
    public function view_list(){
        return view('modulos.parametrizaciones.gestion_procesos.listar_procesos');
    }

    public function view_edit($id){
        $proceso = Proceso::find($id);
        return view('modulos.parametrizaciones.gestion_procesos.editar_procesos', compact("proceso"));
    }

    public function view_create(){
        return view('modulos.parametrizaciones.gestion_procesos.crear_procesos');
    }

    public function list(){
        $procesos = Proceso::all();

        return DataTables::of($procesos)
            ->addColumn('Opciones', function ($proceso) {
                return '<a style="width: 70px;" href="/parametrizaciones/procesos/editar/'.$proceso->id_proceso.'" class="btn btn-sm btn-versatile_reports"><i class="ft-edit"></i> Editar</a>';
            })
            ->rawColumns(['Opciones'])
            ->make(true);
    }

    public function save(Request $request){
        $this->validations($request);

        try {
            Proceso::create([
                'nombre' => $request->nombre
            ]);
            return redirect()->route('listar_procesos')->withSuccess('Se creo el proceso');
        } catch (Exception $e) {
            return redirect()->route('listar_procesos')->withErrors('Ocurrio un error\nError: '.$e->getMessage());
        }
    }

    public function update(Request $request){
        $this->validations($request);

        $proceso = Proceso::find($request->id_proceso);

        if ($proceso == null) {
            return redirect()->route('listar_procesos')->withErrors('El proceso no se encontro');
        }
        try {
            $proceso->update([
                'nombre' => $request->nombre
            ]);
            return redirect()->route('listar_procesos')->withSuccess('Se modifico el proceso');
        } catch (Exception $e) {
            return redirect()->route('listar_procesos')->withErrors('Ocurrio un error\nError: '.$e->getMessage());
        }
    }

    public function validations(Request $request){
        $request->validate([
            'nombre' => 'required|string|min:3|max:30'
        ]);
    }
}
