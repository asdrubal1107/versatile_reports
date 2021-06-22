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
                <h3 class="content-header-title mb-0">Gestion contratistas</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_contratistas') }}">Listar contratistas</a>
                            </li>
                            <li class="breadcrumb-item active">Editar contratista
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
                            <h4 class="card-title">Editar contratista</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-content collapse show">
                                <form id="form_edit_contratista" class="form" action="{{ route('editar_contratistas') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_contratista" id="id_contratista" value="{{ $contratista->id_contratista }}">
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="tipo_documento">Tipo Documento</label>
                                                    <select name="tipo_documento" id="tipo_documento" class="form-control border-primary  @error('tipo_documento') is-invalid @enderror">
                                                        <option value="CC" {{ $contratista->tipo_documento == 'CC' ? 'selected' : '' }}>Cedula Ciudadania</option>
                                                        <option value="CE" {{ $contratista->tipo_documento == 'CE' ? 'selected' : '' }}>Cedula Extranjera</option>
                                                    </select>
                                                    @error('tipo_documento')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="documento">Documento</label>
                                                    <input autocomplete="off" type="text" value="{{ $contratista->documento }}" class="form-control border-primary @error('documento') is-invalid @enderror" name="documento" id="documento">
                                                    @error('documento')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Lugar Expedición / Municipio</label>
                                                    <select id="id_municipio" name="id_municipio" class="form-control border-primary">
                                                        @foreach ($municipios as $item)
                                                            <option {{ $item->id_departamento == $ }} value="{{ $dep->id_departamento }}">{{ $dep->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_municipio')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="nombre">Nombre</label>
                                                    <input autocomplete="off" type="text" value="{{ $contratista->nombre }}" class="form-control border-primary @error('nombre') is-invalid @enderror" name="nombre" id="nombre">
                                                    @error('nombre')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="primer_apellido">Primer Apellido</label>
                                                    <input autocomplete="off" type="text" value="{{ $contratista->primer_apellido }}" class="form-control border-primary @error('primer_apellido') is-invalid @enderror" name="primer_apellido" id="primer_apellido">
                                                    @error('primer_apellido')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="segundo_apellido">Segundo Apellido<span style="font-size: 10px;"> (Opcional)</span></label>
                                                    <input autocomplete="off" type="text" value="{{ $contratista->segundo_apellido }}" class="form-control border-primary @error('segundo_apellido') is-invalid @enderror" name="segundo_apellido" id="segundo_apellido">
                                                    @error('segundo_apellido')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="correo">Correo <span style="font-size: 10px;"> (Opcional)</span></label>
                                                    <input autocomplete="off" type="text" value="{{ $contratista->correo }}" class="form-control border-primary @error('correo') is-invalid @enderror" name="correo" id="correo">
                                                    @error('correo')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="correo_sena">Correo Sena</label>
                                                    <input autocomplete="off" type="text" value="{{ $contratista->correo_sena }}" class="form-control border-primary @error('correo_sena') is-invalid @enderror" name="correo_sena" id="correo_sena">
                                                    @error('correo_sena')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="celular_uno">Celular Uno</label>
                                                    <input autocomplete="off" type="text" value="{{ $contratista->celular_uno }}" class="form-control border-primary @error('celular_uno') is-invalid @enderror" name="celular_uno" id="celular_uno">
                                                    @error('celular_uno')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="celular_dos">Celular Dos <span style="font-size: 10px;"> (Opcional)</span></label>
                                                    <input autocomplete="off" type="text" value="{{ $contratista->celular_dos }}" class="form-control border-primary @error('celular_dos') is-invalid @enderror" name="celular_dos" id="celular_dos">
                                                    @error('celular_dos')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="firma">Firma</label>
                                                    <input autocomplete="off" type="text" value="{{ $contratista->firma }}" class="form-control border-primary @error('firma') is-invalid @enderror" name="firma" id="firma">
                                                    @error('firma')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="fomr-actions text-center">
                                        <a href="{{ route('listar_contratistas') }}" class="btn btn-warning mr-1">
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
    /* $(document).ready(function() {
        $("#form_edit_contratista").validate({
            rules: {
                nombre : {
                  required: true,
                  minlength: 3,
                  maxlength: 30
                }
            },
            messages : {
                nombre: {
                    required: "Nombre del centro es obligatorio",
                    minlength: "Nombre del centro debe contener minimo 3 caracteres",
                    maxlength: "Nombre del centro no puede superar los 30 caracteres"
                }
            }
        });
  }); */

//   $(document).ready(function(){
//     $('#id_departamento').on('change', function(){
//         let id_departamento = $(this).val();
//         if($.trim(id_departamento) != null){
//             $.get('/contratistas/listar/municipios', {id_departamento: id_departamento}, function(municipios){
//                 $('#id_municipio').empty();
//                 $('#id_municipio').append("<option value=''>Seleccione</option>");
//                 $.each(municipios, function (id, nombre){
//                     $('#id_municipio').append("<option {{ "+id+" == $contratista->id_municipio ? 'selected' : '' }} value='"+ id +"'>"+ nombre +"</option>")
//                 })
//             })
//         }
//     })
//   });
</script>
@endsection