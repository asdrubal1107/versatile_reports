<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use DataTables;
use App\Models\Contratista;
use App\Models\Contrato;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Objeto;
use App\Models\Proceso;
use App\Models\Supervisor;

class ContratistaControler extends Controller
{
    /* Gestion Contratistas */
    public function view_list(){
        return view('modulos.gestion_contratistas.listar_contratistas');
    }

    public function view_details($id){
        $contratista = Contratista::join('municipios', 'municipios.id_municipio', '=', 'contratistas.id_municipio')
            ->join('departamentos', 'municipios.id_departamento', '=', 'departamentos.id_departamento')
            ->select('contratistas.*', 'municipios.nombre as nombre_municipio', 'departamentos.nombre as nombre_departamento')
            ->where('contratistas.id_contratista', '=', ''.$id.'')->take(1)
            ->get();
        return view('modulos.gestion_contratistas.detalle_contratista', compact("contratista"));
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
                // $btn_editar = '<a style="width: 30px;" href="/contratistas/editar/'.$contratista->id_contratista.'" class="btn btn-sm btn-versatile_reports"><i class="ft-edit"></i></a>';
                $btn_contratos = '<a style="width: 30px;" href="/contratistas/contratos/listar/'.$contratista->id_contratista.'" class="btn btn-sm btn-info btn-estados"><i class="ft-file"></i></a>';
                $btn_detalles = '<a style="width: 30px;" href="/contratistas/detalles/'.$contratista->id_contratista.'" class="btn btn-sm btn-gris"><i class="ft-eye"></i></a>';
                if ($contratista->estado == 1) {
                    $btn_estado = '<a style="width: 30px;" href="/contratistas/cambiar/estado/'.$contratista->id_contratista.'/0" class="btn btn-sm btn-danger btn-estados"><i class="ft-alert-octagon"></i></a>';
                }else{
                    $btn_estado = '<a style="width: 30px;" href="/contratistas/cambiar/estado/'.$contratista->id_contratista.'/1" class="btn btn-sm btn-success btn-estados"><i class="ft-check-square"></i></a>';
                }
                return /* $btn_editar . ' ' . */ $btn_detalles . ' ' . $btn_contratos . ' ' . $btn_estado;
            })
            ->rawColumns(['Opciones', 'estado'])
            ->make(true);
    }

    public function save(Request $request){
        $this->validations($request);
        $request->validate([
            'documento' => 'required|numeric|digits_between:6,14|unique:contratistas,documento',
            'firma' => 'required|image|mimes:jpeg,png,jpg|max:1024'
        ]);
        try {
            $fecha = Carbon::now();
            $fecha_dia = $fecha->format('d-m-Y');
            $firma = $request->documento.'.'.$fecha_dia.'_'.time().'.'.$request->firma->extension();
            $request->firma->move(public_path('uploads/firmas'), $firma);
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
                'firma' => $firma
            ]);

            return redirect()->route('listar_contratistas')->withSuccess('Se creo con éxito');
        } catch (Exception $e) {
            return redirect()->route('listar_contratistas')->withErrors('Ocurrio un error. Error: '.$e->getMessage());
        }
    }

    public function update(Request $request){
        // dd($request->all()); 1624546683.png
        $this->validations($request);
        $request->validate([
            'documento' => 'required|numeric|digits_between:6,14'
        ]);
        try {
            $contratista = Contratista::find($request->id_contratista);
            if ($contratista == null) {
                return redirect()->route('listar_contratistas')->withErrors('No se actualizo el contratista');
            }
            if ($request->firma != null) {
                $request->validate(['firma' => 'image|mimes:jpeg,png,jpg|max:1024']);
                unlink("uploads/firmas/".$contratista->firma);
                $fecha = Carbon::now();
                $fecha_dia = $fecha->format('d-m-Y');
                $firma = $request->documento.'.'.$fecha_dia.'_'.time().'.'.$request->firma->extension();
                $request->firma->move(public_path('uploads/firmas'), $firma);
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
                    'firma' => $firma
                ]);
            }else{
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
                ]);
            }

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
            'correo' => 'required|email|min:6|max:50',
            'correo_sena' => 'required|email|min:6|max:50',
            'celular_uno' => 'required|string|min:6|max:15',
            'celular_dos' => 'nullable|string|min:6|max:15',
            'estado' => 'in:1,0'
        ]);
    }

    /* Gestion contratistas - Contratos */
    public function view_list_contratos($id){
        $contratista = Contratista::find($id);
        return view('modulos.gestion_contratistas.listar_contratos', compact("contratista"));
    }

    public function view_create_contratos($id){
        $contratista = Contratista::find($id);
        $procesos = Proceso::all();
        $objetos = Objeto::all();
        $supervisores = Supervisor::all();
        $centros = Centro::all();
        $departamentos = Departamento::all();
        return view('modulos.gestion_contratistas.crear_contratos', compact("contratista", "procesos", "objetos", "supervisores", "centros", "departamentos"));
    }

    public function view_edit_contratos($id){
        $procesos = Proceso::all();
        $objetos = Objeto::all();
        $supervisores = Supervisor::all();
        $centros = Centro::all();
        $municipios = Municipio::select('id_municipio', 'nombre')->orderBy('nombre', 'asc')->get();
        $contrato = Contrato::find($id);
        return view('modulos.gestion_contratistas.editar_contratos', compact("contrato","procesos", "objetos", "supervisores", "centros", "municipios"));
    }

    public function get_municipios_contratos(Request $request){
        if ($request->ajax()) {
            $municipios = Municipio::where('id_departamento', '=', $request->id_departamento)->get();
            foreach($municipios as $mun){
                $municipiosArray[$mun->id_municipio] = $mun->nombre;
            }
            return response()->json($municipiosArray);
        }
        return redirect()->route('listar_contratos');
    }

    public function list_contratos($id){
        $contratos = Contrato::join('contratistas', 'contratistas.id_contratista', '=', 'contratos.id_contratista')
        ->select('contratos.*', 'contratistas.nombre', 'contratistas.documento')
        ->where('contratos.id_contratista', '=', ''.$id.'')->get();
        return DataTables::of($contratos)
            ->editColumn('estado', function($contrato){
                if ($contrato->estado == 0) {
                    $estado = '<div style="padding: 6px; font-size: 13px;" class="badge badge-warning">Contrato sin asignar</div>';
                }elseif ($contrato->estado == 1){
                    $estado = '<div style="padding: 6px; font-size: 13px;" class="badge badge-success">Contrato asignado</div>';
                }else{
                    $estado = '<div style="padding: 6px; font-size: 13px;" class="badge badge-danger">Contrato vencido</div>';
                }
                return $estado;
            })
            ->addColumn('Opciones', function ($contrato) {
                if ($contrato->estado == 0) {
                    $btn_detalles = '<a style="width: 30px;" href="/contratistas/contratos/detalles/'.$contrato->id_contrato.'" class="btn btn-sm btn-gris"><i class="ft-eye"></i></a>';
                    $btn_editar = '<a style="width: 30px;" href="/contratistas/contratos/editar/'.$contrato->id_contrato.'" class="btn btn-sm btn-versatile_reports"><i class="ft-edit"></i></a>';
                    $btn_estado = '<a style="width: 30px;" href="/contratistas/contratos/cambiar/estado/'.$contrato->id_contrato.'/1" class="btn btn-sm btn-success btn-estados"><i class="ft-check-square"></i></a>';
                    return $btn_editar . ' ' . $btn_detalles . ' ' . $btn_estado;
                }elseif($contrato->estado == 1){
                    $btn_detalles = '<a style="width: 45px;" href="/contratistas/contratos/detalles/'.$contrato->id_contrato.'" class="btn btn-sm btn-gris"><i class="ft-eye"></i></a>';
                    $btn_estado = '<a style="width: 45px;" href="/contratistas/contratos/cambiar/estado/'.$contrato->id_contrato.'/2" class="btn btn-sm btn-danger btn-estados"><i class="ft-trash"></i></a>';
                    return $btn_detalles . ' ' . $btn_estado;
                }else{
                    $btn_detalles = '<a style="width: 90px;" href="/contratistas/contratos/detalles/'.$contrato->id_contrato.'" class="btn btn-sm btn-gris"><i class="ft-eye"></i></a>';
                    return $btn_detalles;
                }
            })
            ->rawColumns(['Opciones', 'estado'])
            ->make(true);
    }

    public function save_contrato(Request $request){
        $request->validate([
            'numero_contrato' => 'required|string|max:30|unique:contratos,numero_contrato',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'valor_contrato' => 'required|numeric',
            'forma_pago_contrato' => 'required|string|max:2000',
            'id_contratista' => 'required|exists:contratistas,id_contratista',
            'id_proceso' => 'required|exists:procesos,id_proceso',
            'id_objeto' => 'required|exists:objetos,id_objeto',
            'id_supervisor' => 'required|exists:supervisores,id_supervisor',
            'id_centro' => 'required|exists:centros,id_centro',
            'id_municipio' => 'required|exists:municipios,id_municipio'
        ]);
        if($request->fecha_inicio >= $request->fecha_fin){
            return back()->withErrors('La fecha de inicio debe ser mayor a la fecha de finalizacion');
        }
        try {
            Contrato::create([
                'numero_contrato' => $request->numero_contrato,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
                'valor' => $request->valor_contrato,
                'forma_pago' => $request->forma_pago_contrato,
                'id_contratista' => $request->id_contratista,
                'id_proceso' => $request->id_proceso,
                'id_objeto' => $request->id_objeto,
                'id_supervisor' => $request->id_supervisor,
                'id_centro' => $request->id_centro,
                'id_municipio' => $request->id_municipio
            ]);

            return redirect('/contratistas/contratos/listar/'.$request->id_contratista.'')->withSuccess('Se creo con éxito');
        } catch (Exception $e) {
            return redirect('/contratistas/contratos/listar/'.$request->id_contratista.'')->withErrors('Ocurrio un error. Error: '.$e->getMessage());
        }
    }

    public function update_contrato(Request $request){
        $request->validate([
            'numero_contrato' => 'required|string|max:30',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'valor_contrato' => 'required|numeric',
            'forma_pago_contrato' => 'required|string|max:2000',
            'id_contratista' => 'required|exists:contratistas,id_contratista',
            'id_proceso' => 'required|exists:procesos,id_proceso',
            'id_objeto' => 'required|exists:objetos,id_objeto',
            'id_supervisor' => 'required|exists:supervisores,id_supervisor',
            'id_centro' => 'required|exists:centros,id_centro',
            'id_municipio' => 'required|exists:municipios,id_municipio'
        ]);
        if($request->fecha_inicio >= $request->fecha_fin){
            return back()->withErrors('La fecha de inicio debe ser mayor a la fecha de finalizacion');
        }
        $contrato = Contrato::find($request->id_contrato);
        if($contrato == null) return redirect()->route('listar_contratos')->withErrors('El contrato no se pudo actualizar, no fue encontrado');
        try {
            $contrato->update([
                'numero_contrato' => $request->numero_contrato,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
                'valor' => $request->valor_contrato,
                'forma_pago' => $request->forma_pago_contrato,
                'id_contratista' => $request->id_contratista,
                'id_proceso' => $request->id_proceso,
                'id_objeto' => $request->id_objeto,
                'id_supervisor' => $request->id_supervisor,
                'id_centro' => $request->id_centro,
                'id_municipio' => $request->id_municipio
            ]);

            return redirect('/contratistas/contratos/listar/'.$request->id_contratista.'')->withSuccess('Se modifico con éxito');
        } catch (Exception $e) {
            return redirect('/contratistas/contratos/listar/'.$request->id_contratista.'')->withErrors('Ocurrio un error. Error: '.$e->getMessage());
        }
    }

    public function view_details_contratos($id){
        $contrato = Contrato::join('contratistas', 'contratistas.id_contratista', '=', 'contratos.id_contratista')
        ->join('objetos', 'objetos.id_objeto', '=', 'contratos.id_objeto')
        ->join('supervisores', 'supervisores.id_supervisor', '=', 'contratos.id_supervisor')
        ->join('procesos', 'procesos.id_proceso', '=', 'contratos.id_proceso')
        ->join('centros', 'centros.id_centro', '=', 'contratos.id_centro')
        ->join('municipios', 'municipios.id_municipio', '=', 'contratos.id_municipio')
        ->join('departamentos', 'departamentos.id_departamento', '=', 'municipios.id_departamento')
        ->select(
            'contratos.*', 
            'contratistas.nombre as nombre_contratista', 
            'contratistas.primer_apellido as primer_apellido_contratista',
            'contratistas.primer_apellido as segundo_apellido_contratista',
            'contratistas.documento as documento_contratista',
            'contratistas.tipo_documento as tipo_documento_contratista',
            'contratistas.firma as firma_contratista',
            'objetos.nombre as nombre_objeto',  
            'supervisores.nombre as nombre_supervisor',
            'supervisores.primer_apellido as primer_apellido_supervisor',
            'supervisores.segundo_apellido as segundo_apellido_supervisor',
            'procesos.nombre as nombre_proceso',
            'centros.nombre as nombre_centro',
            'municipios.nombre as nombre_municipio',
            'departamentos.nombre as nombre_departamento'
        )->where('contratos.id_contrato', '=', ''.$id.'')->get();
        return view('modulos.gestion_contratistas.detalle_contratos', compact("contrato"));
    }

    public function estado_contrato($id, $estado){
        try {
            $contrato = Contrato::find($id);
            if ($estado == 1) {
                $contrato_viejo = Contrato::select('id_contrato')->where('estado', '=', '1');
                if ($contrato_viejo != null) {
                    $contrato_viejo->update([
                        'estado' => 2
                    ]);
                }
                if ($contrato == null) {
                    return back()->withErrors('No se encontro el contrato');
                }
                $contrato->update([
                    'estado' => $estado
                ]);
                return back()->withSuccess('Contrato asignado');
            }elseif ($estado == 2) {
                $contrato->update([
                    'estado' => $estado
                ]);
                return back()->withSuccess('Contrato finalizado');
            }
        } catch (Exception $e) {
            return back()->withErrors('Ocurrio un error: '.$e->getMessage());
        }
    }
}
