@extends('layouts.principal')

@section('style')
    {{-- <style>
        .error{
            color: red;
            font-style: italic;
        }
    </style> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/plugins/forms/wizard.css') }}">
@endsection

@section('contenido')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Gestion de contratistas / Gestion de contratos</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_contratistas') }}">Listar contratistas</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_contratos', ['id' => $contratista->id_contratista]) }}">Listar contratos</a>
                            </li>
                            <li class="breadcrumb-item active">Crear contrato
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
                            <h4 class="card-title">Crear contrato</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-content collapse show">
                                <form id="form_crear_contrato" action="{{ route('crear_contratos') }}" class="number-tab-steps wizard-circle" method="POST" >
                                    @csrf
                                    <input type="hidden" name="id_contratista" id="id_contratista" value="{{ $contratista->id_contratista }}">

                                    <!-- Paso 1 -->
                                    <h6>Paso 1</h6>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="numero_contrato">Numero contrato: (*)</label>
                                                    <input type="text" class="form-control border-primary @error('numero_contrato') is-invalid @enderror" name="numero_contrato" id="numero_contrato">
                                                    @error('numero_contrato')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="fecha_inicio">Fecha inicio: (*)</label>
                                                    <input type="date" class="form-control border-primary @error('fecha_inicio') is-invalid @enderror" name="fecha_inicio" id="fecha_inicio">
                                                    @error('fecha_inicio')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="fecha_fin">Fecha fin: (*)</label>
                                                    <input type="date" class="form-control border-primary @error('fecha_fin') is-invalid @enderror" name="fecha_fin" id="fecha_fin">
                                                    @error('fecha_fin')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <!-- Paso 2 -->
                                    <h6>Paso 2</h6>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="valor_contrato">Valor del contrato: (*)</label>
                                                    <input step="1" type="num" class="form-control border-primary @error('valor_contrato') is-invalid @enderror" name="valor_contrato" id="valor_contrato">
                                                    @error('valor_contrato')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="forma_pago_contrato">Forma de pago del contrato: (*)</label>
                                                    <textarea name="forma_pago_contrato" id="forma_pago_contrato" cols="30" rows="5" class="form-control border-primary @error('forma_pago_contrato') is-invalid @enderror"></textarea>
                                                    @error('forma_pago_contrato')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="estado_contrato">Estado: (*)</label>
                                                    <select name="estado_contrato" id="estado_contrato" class="form-control border-primary @error('estado_contrato') is-invalid @enderror">
                                                        <option value="0">Sin asignar</option>
                                                        <option value="1">Asignado</option>
                                                    </select>
                                                    @error('estado_contrato')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <!-- Paso 3 -->
                                    <h6>Paso 3</h6>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="id_objeto">Objeto de contrato:</label>
                                                    <select name="id_objeto" id="id_objeto" class="form-control border-primary @error('id_objeto') @enderror">
                                                        <option value="1">{{ $objetos[1]->nombre }}</option>
                                                        {{-- <option value="{{ $objetos[1]->id_objeto }}">{{ $objetos[1]->nombre }}</option> --}}
                                                    </select>
                                                    @error('id_objeto')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="id_supervisor">Supervisor a cargo:</label>
                                                    <select name="id_supervisor" id="id_supervisor" class="form-control border-primary @error('id_supervisor') @enderror">
                                                        <option value="">Seleccione</option>
                                                        @foreach ($supervisores as $item)
                                                            <option value="{{ $item->id_supervisor }}">{{ /* $item->documento */ $item->nombre . ' ' . $item->primer_apellido }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_supervisor')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="id_proceso">Proceso:</label>
                                                    <select name="id_proceso" id="id_proceso" class="form-control border-primary @error('id_proceso') @enderror">
                                                        <option value="">Seleccione</option>
                                                        @foreach ($procesos as $item)
                                                            <option value="{{ $item->id_proceso }}">{{ $item->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_proceso')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <!-- Paso 4 -->
                                    <h6>Paso 4</h6>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="id_centro">Centro SENA:</label>
                                                    <select name="id_centro" id="id_centro" class="form-control border-primary @error('id_centro') @enderror">
                                                        <option value="">Seleccione</option>
                                                        @foreach ($centros as $item)
                                                            <option value="{{ $item->id_centro }}">{{ $item->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_centro')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="id_municipio">Departamento / Ciudad (*):</label>
                                                    <select name="id_municipio" id="id_municipio" class="form-control border-primary @error('id_municipio') @enderror">
                                                        <option value="3">Municipio</option>
                                                        {{-- @foreach ($centros as $item)
                                                            <option value="{{ $item->id_municipio }}">{{ $item->nombre }}</option>
                                                        @endforeach --}}
                                                    </select>
                                                    @error('id_municipio')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table style="width: 100%;" class="table table-bordered">
                                                        <thead>
                                                            <th class="align-center">CONTRATISTA: {{ $contratista->nombre . ' ' . $contratista->primer_apellido }}.</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <table class="table table-column">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td><strong>Nombres: </strong><td>{{ $contratista->nombre }}.</td></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Apellidos: </strong><td>{{ $contratista->primer_apellido . ' ' . $contratista->segundo_apellido }}.</td></td>
                                                                            </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
/* $(document).ready(function() {
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
                required: true,
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
                maxlength: 40,
                extension: "png|jpeg|jpg"
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
                required: "Correo personal es obligatorio",
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
                maxlength: "La firma debe ser de por lo menos 40 caracteres",
                extension: "La firma debe ser un archivo png, jpg o jpeg"
            }
        }
    });
}); */

/* $(document).ready(function(){
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
  }); */
</script>

<script src="{{ asset('dashboard/app-assets/vendors/js/extensions/jquery.steps.min.js') }}"></script>

<script>
    $(".number-tab-steps").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        previous: "Anterior",
        next: "Siguiente",
        finish: 'Crear contrato'
    },
    onFinished: function (event, currentIndex) {
        $('#form_crear_contrato').submit()
    }
});
</script>
@endsection