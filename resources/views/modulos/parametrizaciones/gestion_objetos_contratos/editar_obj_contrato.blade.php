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
                <h3 class="content-header-title mb-0">Gestion objetos de contrato</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_objetos_contratos') }}">Listar objetos de contrato</a>
                            </li>
                            <li class="breadcrumb-item active">Editar objeto de contrato
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
                            <h4 class="card-title">Editar objeto de contrato</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-content collapse show">
                                <form id="form_edit_objeto" class="form" action="{{ route('editar_objeto_contrato') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_objeto" id="id_objeto" value="{{ $objeto->id_objeto }}">
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="nombre">Nombre objeto contrato (*)</label>
                                                    <input autocomplete="off" type="text" value="{{ $objeto->nombre }}" class="form-control border-primary @error('nombre') is-invalid @enderror" name="nombre" id="nombre">
                                                    @error('nombre')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="detalle">Detalle objeto contrato (*)</label>
                                                    {{-- <input type="text" value="{{ $objeto->detalle }}" class="form-control border-primary @error('detalle') is-invalid @enderror" name="detalle" id="detalle"> --}}
                                                    <textarea name="detalle" class="form-control border-primary @error('nombre') is-invalid @enderror" id="detalle" cols="30" rows="10">{{ $objeto->detalle }}</textarea>
                                                    @error('detalle')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="fomr-actions text-center">
                                        <a href="{{ route('listar_objetos_contratos') }}" class="btn btn-warning mr-1">
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
        $("#form_edit_objeto").validate({
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
@endsection