@extends('layouts.principal')

@section('contenido')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Revisión requerimientos</h3>
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
                            <h4 class="card-title">Revisión de requerimientos</h4>
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
                                            <th>Fecha creación</th>
                                            <th>Fecha finalización</th>
                                            <th style="width: 270px;">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Salud ocupacional</td>
                                            <td>Buenas tardes, porfavor adjuntar copia de la salud ocupacional del mes de octube</td>
                                            <td>25/06/2021</td>
                                            <td>21//06/2021</td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-estados"><i class="ft-eye"> Ver detalles</i></a>
                                                <a href="#" class="btn btn-versatile_reports"><i class="ft-edit"> Editar </i></a>
                                            </td>   
                                        </tr>
                                        <tr>
                                            <td>Salud ocupacional</td>
                                            <td>Buenas tardes, porfavor adjuntar copia de la salud ocupacional del mes de octube</td>
                                            <td>25/06/2021</td>
                                            <td>21//06/2021</td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-estados"><i class="ft-eye"> Ver detalles</i></a>
                                                <a href="#" class="btn btn-versatile_reports"><i class="ft-edit"> Editar </i></a>
                                            </td>   
                                        </tr>
                                        <tr>
                                            <td>Salud ocupacional</td>
                                            <td>Buenas tardes, porfavor adjuntar copia de la salud ocupacional del mes de octube</td>
                                            <td>25/06/2021</td>
                                            <td>21//06/2021</td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-estados"><i class="ft-eye"> Ver detalles</i></a>
                                                <a href="#" class="btn btn-versatile_reports"><i class="ft-edit"> Editar </i></a>
                                            </td>   
                                        </tr>
                                        <tr>
                                            <td>Salud ocupacional</td>
                                            <td>Buenas tardes, porfavor adjuntar copia de la salud ocupacional del mes de octube</td>
                                            <td>25/06/2021</td>
                                            <td>21//06/2021</td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-estados"><i class="ft-eye"> Ver detalles</i></a>
                                                <a href="#" class="btn btn-versatile_reports"><i class="ft-edit"> Editar </i></a>
                                            </td>   
                                        </tr>
                                        <tr>
                                            <td>Salud ocupacional</td>
                                            <td>Buenas tardes, porfavor adjuntar copia de la salud ocupacional del mes de octube</td>
                                            <td>25/06/2021</td>
                                            <td>21//06/2021</td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-estados"><i class="ft-eye"> Ver detalles</i></a>
                                                <a href="#" class="btn btn-versatile_reports"><i class="ft-edit"> Editar </i></a>
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