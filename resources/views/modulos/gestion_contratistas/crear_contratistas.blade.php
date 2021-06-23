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
                <h3 class="content-header-title mb-0">Gestion contratistas</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_contratistas') }}">Listar contratistas</a>
                            </li>
                            <li class="breadcrumb-item active">Crear contratista
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
                            <h4 class="card-title">Crear contratista</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-content collapse show">
                                <form id="form_crear_contratista" class="form" action="{{ route('crear_contratistas') }}" method="POST">
                                    @csrf
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="tipo_documento">Tipo Documento (*)</label>
                                                    <select name="tipo_documento" id="tipo_documento" class="form-control border-primary  @error('tipo_documento') is-invalid @enderror">
                                                        <option value="">Seleccione un tipo de documento</option>
                                                        <option value="CC">Cedula Ciudadania</option>
                                                        <option value="CE">Cedula Extranjera</option>
                                                    </select>
                                                    @error('tipo_documento')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="documento">Documento (*)</label>
                                                    <input autocomplete="off" type="text" class="form-control border-primary @error('documento') is-invalid @enderror" name="documento" id="documento">
                                                    @error('documento')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Lugar Expedición / Departamento / Municipio (*)</label>
                                                    <select id="id_departamento" name="id_departamento" class="form-control border-primary">
                                                        <option value="">Seleccione el departamento</option>
                                                        @foreach ($departamentos as $item)
                                                            <option value="{{ $item->id_departamento }}">{{ $item->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="dropdown-divider"></div>
                                                    <select name="id_municipio" id="id_municipio" class="form-control border-primary @error('id_municipio') is-invalid @enderror"></select>
                                                    @error('id_municipio')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="nombre">Nombre (*)</label>
                                                    <input autocomplete="off" type="text" class="form-control border-primary @error('nombre') is-invalid @enderror" name="nombre" id="nombre">
                                                    @error('nombre')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="primer_apellido">Primer Apellido (*)</label>
                                                    <input autocomplete="off" type="text" class="form-control border-primary @error('primer_apellido') is-invalid @enderror" name="primer_apellido" id="primer_apellido">
                                                    @error('primer_apellido')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="segundo_apellido">Segundo Apellido<span style="font-size: 10px;"> (Opcional)</span></label>
                                                    <input autocomplete="off" type="text" class="form-control border-primary @error('segundo_apellido') is-invalid @enderror" name="segundo_apellido" id="segundo_apellido">
                                                    @error('segundo_apellido')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="correo">Correo <span style="font-size: 10px;"> (Opcional)</span></label>
                                                    <input autocomplete="off" type="text" class="form-control border-primary @error('correo') is-invalid @enderror" name="correo" id="correo">
                                                    @error('correo')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="correo_sena">Correo Sena (*)</label>
                                                    <input autocomplete="off" type="text" class="form-control border-primary @error('correo_sena') is-invalid @enderror" name="correo_sena" id="correo_sena">
                                                    @error('correo_sena')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="celular_uno">Celular Uno (*)</label>
                                                    <input autocomplete="off" type="text" class="form-control border-primary @error('celular_uno') is-invalid @enderror" name="celular_uno" id="celular_uno">
                                                    @error('celular_uno')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="celular_dos">Celular Dos <span style="font-size: 10px;"> (Opcional)</span></label>
                                                    <input autocomplete="off" type="text" class="form-control border-primary @error('celular_dos') is-invalid @enderror" name="celular_dos" id="celular_dos">
                                                    @error('celular_dos')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="firma">Firma (*)</label>
                                                    <input autocomplete="off" type="text" class="form-control border-primary @error('firma') is-invalid @enderror" name="firma" id="firma">
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
$(document).ready(function() {
    $("#form_crear_contratista").validate({
        rules: {
            documento : {
                required: true,
                number: true,
                minlength: 6,
                maxlength: 14
            },
            nombre : {
                required: true,
                minlength: 3,
                maxlength: 40
            },
            primer_apellido : {
                required: true,
                minlength: 3,
                maxlength: 30
            },
            segundo_apellido : {
                minlength: 3,
                maxlength: 30
            },
            correo_sena : {
                required: true,
                email: true,
                minlength: 6,
                maxlength: 50
            },
            correo : {
                email: true,
                minlength: 6,
                maxlength: 50
            },
            celular_uno : {
                required: true,
                minlength: 6,
                maxlength: 15
            },
            celular_dos : {
                minlength: 6,
                maxlength: 15
            },
            id_municipio: {
                required: true,
            },
            tipo_documento: {
                required: true,
            },
            firma: {
                required: true,
                minlength: 4,
                maxlength: 40
                // extension: "png|jpeg|jpg"
            }
        },
        messages : {
            documento: {
                required: "Documento es obligatorio",
                number: "Documento debe ser numerico",
                minlength: "Documento debe contener por lo menos 6 digitos",
                maxlength: "Documento debe contener como maximo 14 digitos"
            },
            nombre: {
                required: "Nombre del contratista es obligatorio",
                minlength: "El nombre debe contener por lo menos 3 caracteres",
                maxlength: "El nombre debe contener como maximo 40 caracteres"
            },
            primer_apellido: {
                required: "Primer apellido del contratista es obligatorio",
                minlength: "El apellido debe contener por lo menos 3 caracteres",
                maxlength: "El apellido debe contener como maximo 30 caracteres"
            },
            segundo_apellido: {
                minlength: "El apellido debe contener por lo menos 3 caracteres",
                maxlength: "El apellido debe contener como maximo 30 caracteres"
            },
            correo_sena: {
                required: "Correo del sena es obligatorio",
                email: "Ejemplo de correo ejemplo@ejemplo.com",
                minlength: "Correo del sena debe contener por lo menos 6 caracteres",
                maxlength: "Correo del sena debe contener como maximo 50 caracteres"
            },
            correo: {
                email: "Ejemplo de correo ejemplo@ejemplo.com",
                minlength: "Correo debe contener por lo menos 6 caracteres",
                maxlength: "Correo debe contener como maximo 50 caracteres"
            },
            celular_uno: {
                required: "Celular uno es obligatorio",
                minlength: "Celular uno debe contener por lo menos 6 caracteres",
                maxlength: "Celular uno debe contener como maximo 15 caracteres"
            },
            celular_dos: {
                minlength: "Celular dos debe contener por lo menos 6 caracteres",
                maxlength: "Celular dos debe contener como maximo 15 caracteres"
            },
            id_municipio: {
                required: "Debe seleccionar un lugar de expedición",
            },
            tipo_documento: {
                required: "Debe seleccionar un tipo de documento",
            },
            firma: {
                required: "La firma es obligatoria",
                minlength: "La firma debe ser de por lo menos 6 caracteres",
                maxlength: "La firma debe ser de por lo menos 40 caracteres"
                // extension: "La firma debe ser un archivo png, jpg o jpeg"
            }
        }
    });
});

$(document).ready(function(){
    $('#id_departamento').on('change', function(){
        let id_departamento = $(this).val();
        if($.trim(id_departamento) != null){
            $.get('/contratistas/listar/municipios', {id_departamento: id_departamento}, function(municipios){
                $('#id_municipio').empty();
                $('#id_municipio').append("<option value=''>Seleccione el municipio</option>");
                $.each(municipios, function (id, nombre){
                    $('#id_municipio').append("<option value='"+ id +"'>"+ nombre +"</option>")
                })
            })
        }
    })
  });
</script>
@endsection