<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Contratista;
use App\Models\Departamento;
use App\Models\Municipio;
use Exception;

class ContratistaControler extends Controller
{
    public function view_list(){
        return view('modulos.gestion_contratistas.listar_contratistas');
    }

    public function view_details(){

    }

    public function view_edit($id){
        $contratista = Contratista::find($id);
        $municipios = Municipio::select('id_municipio', 'nombre', 'id_departamento')->orderBy('nombre', 'asc')->get();
        return view('modulos.gestion_contratistas.editar_contratistas', compact("contratista", "municipios"));
    }

    public function get_municipios(Request $request){
        if ($request->ajax()) {
            $municipios = Municipio::where('id_departamento', '=', $request->id_departamento)->get();
            foreach($municipios as $mun){
                $municipiosArray[$mun->id_municipio] = $mun->nombre;
            }
            return response()->json($municipiosArray);
        }
        return redirect()->route('listar_contratistas');
    }

    public function view_create(){
        $departamentos = Departamento::all();
        return view('modulos.gestion_contratistas.crear_contratistas', compact("departamentos"));
    }

    public function list(){
        $contratistas = Contratista::all();

        return DataTables::of($contratistas)
            ->editColumn('estado', function($contratista){
                if ($contratista->estado == 1) {
                    $estado = '<div style="padding: 6px; font-size: 13px;" class="badge badge-success">Activo</div>';
                }else{
                    $estado = '<div style="padding: 6px; font-size: 13px;" class="badge badge-danger">Inactivo</div>';
                }
                return $estado;
            })
            ->addColumn('Opciones', function ($contratista) {
                $btn_editar = '<a style="width: 30px;" href="/contratistas/editar/'.$contratista->id_contratista.'" class="btn btn-sm btn-versatile_reports"><i class="ft-edit"></i></a>';
                $btn_contratos = '<a style="width: 30px;" href="/contratistas/contratos/'.$contratista->id_contratista.'" class="btn btn-sm btn-info btn-estados"><i class="ft-file"></i></a>';
                $btn_detalles = '<a style="width: 30px;" href="/contratistas/detalles/'.$contratista->id_contratista.'" class="btn btn-sm btn-success btn-estados"><i class="ft-eye"></i></a>';
                if ($contratista->estado == 1) {
                    $btn_estado = '<a style="width: 30px;" href="/contratistas/cambiar/estado/'.$contratista->id_contratista.'/0" class="btn btn-sm btn-danger btn-estados"><i class="ft-alert-octagon"></i></a>';
                }else{
                    $btn_estado = '<a style="width: 30px;" href="/contratistas/cambiar/estado/'.$contratista->id_contratista.'/1" class="btn btn-sm btn-success btn-estados"><i class="ft-check-square"></i></a>';
                }
                return $btn_editar . ' ' . $btn_detalles . ' ' . $btn_contratos . ' ' . $btn_estado;
            })
            ->rawColumns(['Opciones', 'estado'])
            ->make(true);
    }

    public function save(Request $request){
        $this->validations($request);
        $request->validate([
            'documento' => 'required|numeric|digits_between:6,14|unique:contratistas,documento',
        ]);
        try {
            Contratista::create([
                'tipo_documento' => $request->tipo_documento,
                'documento' => $request->documento,
                'id_municipio' => $request->id_municipio,
                'nombre' => $request->nombre,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'correo' => $request->correo,
                'correo_sena' => $request->correo_sena,
                'celular_uno' => $request->celular_uno,
                'celular_dos' => $request->celular_dos,
                'firma' => $request->firma
            ]);

            return redirect()->route('listar_contratistas')->withSuccess('Se creo con éxito');
        } catch (Exception $e) {
            return redirect()->route('listar_contratistas')->withErrors('Ocurrio un error. Error: '.$e->getMessage());
        }
    }

    public function update(Request $request){
        $this->validations($request);
        $request->validate([
            'documento' => 'required|numeric|digits_between:6,14',
        ]);
        try {
            $contratista = Contratista::find($request->id_contratista);
            if ($contratista == null) {
                return redirect()->route('listar_contratistas')->withErrors('No se actualizo el contratista');
            }
            $contratista->update([
                'tipo_documento' => $request->tipo_documento,
                'documento' => $request->documento,
                'id_municipio' => $request->id_municipio,
                'nombre' => $request->nombre,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'correo' => $request->correo,
                'correo_sena' => $request->correo_sena,
                'celular_uno' => $request->celular_uno,
                'celular_dos' => $request->celular_dos,
                'firma' => $request->firma
            ]);

            return redirect()->route('listar_contratistas')->withSuccess('Se modifico con éxito');
        } catch (Exception $e) {
            return redirect()->route('listar_contratistas')->withErrors('Ocurrio un error. Error: '.$e->getMessage());
        }
    }

    public function update_state($id, $estado){
        $contratista = Contratista::find($id);

        if ($contratista == null) {
            return redirect()->route('listar_contratistas')->withErrors('No se encontro el contratista');
        }

        if ($estado != 1 && $estado != 0) {
            return redirect()->route('listar_contratistas')->withErrors('El estado no se pudo actualizar');
        }

        try{
            $contratista->update(['estado' => $estado]);
            return redirect()->route('listar_contratistas')->withSuccess('Se modifico el estado del contratista');
        }catch(Exception $e){
            return redirect()->route('listar_contratistas')->withErrors('Ocurrio un error\nError: '.$e->getMessage());
        }
    }

    public function validations(Request $request){
        $request->validate([
            'tipo_documento' => 'required|in:CC,CE',
            'id_municipio' => 'required|exists:municipios,id_municipio',
            'nombre' => 'required|string|min:3|max:40',
            'primer_apellido' => 'required|string|min:3|max:30',
            'segundo_apellido' => 'nullable|string|min:3|max:30',
            'correo' => 'nullable|email|min:6|max:50',
            'correo_sena' => 'required|email|min:6|max:50',
            'celular_uno' => 'required|string|min:6|max:15',
            'celular_dos' => 'nullable|string|min:6|max:15',
            'firma' => 'required|string|min:4|max:40', //Organizar validacion para que sea de tipo field
            'estado' => 'in:1,0'
        ]);
    }
}
