@extends('layouts.principal')

@section('style')
    <style>
        .error{
            color: red;
            font-style: italic;
        }
    </style>
@endsection

@section('contenido')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Gestion de actividades</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_actividades') }}">Listar actividades</a>
                            </li>
                            <li class="breadcrumb-item active">Crear actividad
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
                            <h4 class="card-title">Crear actividad</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-content collapse show">
                                <form id="form_crear_actividades" class="form" action="{{ route('crear_actividades') }}" method="POST">
                                    @csrf
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="detalle">Detalle actividad (*)</label>
                                                    <input autocomplete="off" type="text" class="form-control border-primary @error('detalle') is-invalid @enderror" name="detalle" id="detalle">
                                                    @error('detalle')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_obligacion">Obligación (*)</label>
                                                    <select class="form-control border-primary @error('id_obligacion') is-invalid @enderror" name="id_obligacion" id="id_obligacion">
                                                        <option value="">Seleccion la obligación</option>
                                                        @foreach ($obligaciones as $item)
                                                            <option value="{{ $item->id_obligacion }}">{{ $item->detalle }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_obligacion')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="fomr-actions text-center">
                                        <a href="{{ route('listar_actividades') }}" class="btn btn-warning mr-1">
                                            <i class="la la-close"></i>
                                            Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-save"></i>
                                            Guardar
                                        </button>
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

@section('javascript')
<script>
    $(document).ready(function() {
        $("#form_crear_actividades").validate({
            rules: {
                detalle : {
                  required: true,
                  minlength: 3
                },
                id_obligacion : {
                  required: true,
                }
            },
            messages : {
                detalle : {
                  required: "Este campo es obligatorio",
                  minlength: "El detalle debe contener minimo 3 caracteres"
                },
                id_obligacion : {
                  required: "Este campo es obligatorio",
                }
            }
        });
    });
</script>
@endsection