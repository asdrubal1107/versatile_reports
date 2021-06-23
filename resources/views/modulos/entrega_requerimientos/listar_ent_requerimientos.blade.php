@extends('layouts.principal')

@section('contenido')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Entrega requerimientos</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Lista requerimientos
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body"> 
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Entrega de requerimientos</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="table-responsive">
                                <table class="table table-column">
                                    <thead>
                                        <tr>
                                            <th>Requerimiento</th>
                                            <th>Detalles</th>
                                            <th>Fecha finalización</th>
                                            <th>Estado</th>
                                            <th style="width: 285px; text-align: center;">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Salud ocupacional</td>
                                            <td>Buenas tardes, porfavor adjuntar copia de la salud ocupacional del mes de octube</td>
                                            <td>25/06/2021</td>
                                            <td>No aprobado</td>
                                            <td style="width: 285px">
                                                <a href="#" style="width: 100px;" class="btn btn-versatile_reports"><i class="ft-paperclip"> Entregar</i></a>
                                                <a href="#" style="width: 100px;" class="btn btn-info btn-estados"><i class="ft-download"> Descargar</i></a>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Informe</td>
                                            <td>Buenas tardes, completar y entregar el informe antes de la fecha plazo, muchas gracias</td>
                                            <td>20/06/2021</td>
                                            <td>Aprobado</td>
                                            <td style="width: 285px">
                                                <a href="#" style="width: 100px;" class="btn btn-versatile_reports"><i class="ft-paperclip"> Entregar</i></a>
                                                <a href="#" style="width: 100px;" class="btn btn-info btn-estados"><i class="ft-file"> Reporte</i></a>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Salud ocupacional</td>
                                            <td>Buenas tardes, porfavor adjuntar copia de la salud ocupacional del mes de octube</td>
                                            <td>25/06/2021</td>
                                            <td>No aprobado</td>
                                            <td style="width: 285px">
                                                <a href="#" style="width: 100px;" class="btn btn-versatile_reports"><i class="ft-paperclip"> Entregar</i></a>
                                                <a href="#" style="width: 100px;" class="btn btn-info btn-estados"><i class="ft-download"> Descargar</i></a>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Informe</td>
                                            <td>Buenas tardes, completar y entregar el informe antes de la fecha plazo, muchas gracias</td>
                                            <td>20/06/2021</td>
                                            <td>Aprobado</td>
                                            <td style="width: 285px">
                                                <a href="#" style="width: 100px;" class="btn btn-versatile_reports"><i class="ft-paperclip"> Entregar</i></a>
                                                <a href="#" style="width: 100px;" class="btn btn-info btn-estados"><i class="ft-file"> Reporte</i></a>
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
@endsection