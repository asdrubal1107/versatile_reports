@extends('layouts.principal')

{{-- @section('style')
    <style>
        .error{
            color: red;
            font-style: italic;
        }
    </style>
@endsection --}}

@section('contenido')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Generar reporte de contratistas</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_contratistas') }}">Lista de contratistas</a>
                            </li>
                            <li class="breadcrumb-item active">Generar reporte de contratistas
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
                            <h4 class="card-title">Generar reporte</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                <p><strong>Nota:</strong>&nbsp;El reporte solo consultará los contratistas con contratos activos.</p>
                            </div>
                            <div class="card-content collapse show">
                                <form action="{{ route('generar_reporte_contratistas') }}" method="POST" class="form">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="criterio">Criterio de busqueda (*)</label>
                                                    <select class="form-control border-primary" name="criterio" id="criterio">
                                                        <option value="">Seleccione un Criterio</option>
                                                        <option value="fecha_inicio">Fecha inicio</option>
                                                        <option value="fecha_fin">Fecha fin</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fecha_inicio">Fecha inicio</label>
                                                    <input name="fecha_inicio" id="fecha_inicio" type="date" class="form-control border-primary" name="" id="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fecha_fin">Fecha fin</label>
                                                    <input name="fecha_fin" id="fecha_fin" type="date" class="form-control border-primary" name="" id="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions text-center">
                                        <div class="row justify-content-center mb-1">
                                            <input type="submit" name="pdf" class="btn btn-versatile_reports col-md-2 mr-1" value="Generar PDF">
                                            <input type="submit" name="excel" class="btn btn-gris col-md-2 ml-1" value="Generar EXCEL">
                                        </div>
                                        <div class="row justify-content-center">
                                            <a href="{{ route('listar_contratistas') }}" class="btn btn-warning btn-estados col-md-4"><i class="ft-x">Cancelar</i></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin tabla hoverable -->
        </div>
    </div>
</div>
@endsection

{{-- @section('javascript')
<script>
    $(document).ready(function() {
        $("#form_crear_objeto").validate({
            rules: {
                nombre : {
                  required: true,
                  minlength: 3,
                  maxlength: 40
                },
                detalle : {
                  required: true,
                  minlength: 20,
                  maxlength: 600
                },
            },
            messages : {
                nombre: {
                    required: "Por favor ingrese el nombre del objeto de contrato",
                    minlength: "El nombre debe contener por lo menos 3 caracteres",
                    maxlength: "El nombre debe contener como maximo 40 caracteres"
                },
                detalle: {
                    required: "Por favor ingrese un detalle del objeto de contrato",
                    minlength: "El detalle debe contener por lo menos 20 caracteres",
                    maxlength: "El detalle debe contener como maximo 600 caracteres"
                }
            }
        });
  });
</script>
@endsection --}}