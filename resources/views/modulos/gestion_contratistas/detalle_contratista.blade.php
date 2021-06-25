@extends('layouts.principal')

@section('contenido')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Gestion contratistas</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_contratistas') }}">Listar contratistas</a>
                            </li>
                            <li class="breadcrumb-item active">Detalle contratista
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
                            <h4 class="card-title">Detalle contratista</h4>
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
                                            <th class="align-center">CONTRATISTA: {{ $contratista[0]->nombre . ' ' . $contratista[0]->primer_apellido }}.</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table class="table table-column">
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>Nombres: </strong><td>{{ $contratista[0]->nombre }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Apellidos: </strong><td>{{ $contratista[0]->primer_apellido . ' ' . $contratista[0]->segundo_apellido }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Tipo documento: </strong><td>{{ $contratista[0]->tipo_documento == 'CC' ? 'Cedula Ciudadania' : 'Cedula Extranjera'  }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Documento: </strong><td>{{ $contratista[0]->documento }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Lugar expedición: </strong><td>{{ $contratista[0]->nombre_departamento . ' / ' . $contratista[0]->nombre_municipio }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Correo: </strong><td>{{ $contratista[0]->correo != '' ? $contratista[0]->correo : 'No registro' }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Correo Institucional: </strong><td>{{ $contratista[0]->correo_sena }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Celular uno: </strong><td>{{ $contratista[0]->celular_uno }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Celular dos: </strong><td>{{ $contratista[0]->celular_dos != '' ? $contratista[0]->celular_dos : 'No registro' }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Firma: </strong><td><img src="{{ asset('uploads/firmas/'.$contratista[0]->firma.'') }}" width="80" height="80"></td></td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <div class="container">
                                                                        <div class="row justify-content-center">
                                                                            <div class="col-md-4">
                                                                                <a href="{{ route('listar_contratistas') }}" class="btn btn-gris col-8 ml-5">Regresar</a>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <a href="{{ url('/contratistas/editar/'.$contratista[0]->id_contratista.'') }}" class="btn btn-versatile_reports col-8">Editar</a>
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