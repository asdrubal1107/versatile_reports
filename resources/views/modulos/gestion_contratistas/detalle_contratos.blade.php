@extends('layouts.principal')

@section('contenido')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Gestion contratos</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_contratistas') }}">Listar contratistas</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_contratos', ['id' => $contrato[0]->id_contratista]) }}">Listar contratos</a>
                            </li>
                            <li class="breadcrumb-item active">Detalle contrato
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body"> 
            <!-- Inicio tabla hoverable -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Detalle contrato</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-content collapse show">
                                <div class="table-responsive">
                                    <table style="width: 100%;" class="table table-bordered">
                                        <thead>
                                            <th class="align-center">CONTRATISTA: {{ $contrato[0]->nombre_contratista . ' ' . $contrato[0]->primer_apellido_contratista }}.</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table class="table table-column">
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>Nombres: </strong><td>{{ $contrato[0]->nombre_contratista }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Apellidos: </strong><td>{{ $contrato[0]->primer_apellido_contratista . ' ' . $contrato[0]->segundo_apellido_contratista }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Tipo documento: </strong><td>{{ $contrato[0]->tipo_documento_contratista == 'CC' ? 'Cedula Ciudadania' : 'Cedula Extranjera'  }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Documento: </strong><td>{{ $contrato[0]->documento_contratista }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Lugar expedición: </strong><td>{{ $contrato[0]->nombre_departamento . ' / ' . $contrato[0]->nombre_municipio }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Numero de contrato: </strong><td>{{ $contrato[0]->numero_contrato }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Fecha inicio contrato: </strong><td>{{ $contrato[0]->fecha_inicio }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Fecha fin contrato: </strong><td>{{ $contrato[0]->fecha_fin }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Valor del contrato: </strong><td>{{ $contrato[0]->valor }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Forma de pago del contrato: </strong><td>{{ $contrato[0]->forma_pago }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Estado del contrato: </strong><td>{{ $contrato[0]->estado == 0 ? 'Sin asignar' : ($contrato[0]->estado == 1 ? 'Contrato asignado' : 'Contrato vencido') }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Proceso: </strong><td>{{ $contrato[0]->nombre_proceso }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Objeto de contrato: </strong><td>{{ $contrato[0]->nombre_objeto }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Supervisor del contrato: </strong><td>{{ $contrato[0]->nombre_supervisor.' '.$contrato[0]->primer_apellido_supervisor.' '.$contrato[0]->segundo_apellido_supervisor }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Centro SENA: </strong><td>{{ $contrato[0]->nombre_centro }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Departamento - Municipio: </strong><td>{{ $contrato[0]->nombre_departamento.' - '.$contrato[0]->nombre_municipio }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Firma: </strong><td><img src="{{ asset('uploads/firmas/'.$contrato[0]->firma_contratista.'') }}" width="80" height="80"></td></td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <div class="container">
                                                                        <div class="row justify-content-center">
                                                                            <div class="col-md-4">
                                                                                <a href="{{ route('listar_contratos', ['id' => $contrato[0]->id_contratista]) }}" class="btn btn-gris col-8 ml-5">Regresar</a>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <a href="{{ url('/contratistas/contratos/editar/'.$contrato[0]->id_contrato.'') }}" class="btn btn-versatile_reports col-8">Editar</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection