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
                <h3 class="content-header-title mb-0">Gestion de requerimientos</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_requerimientos') }}">Lista de requerimientos</a>
                            </li>
                            <li class="breadcrumb-item active">Crear requerimiento
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
                            <h4 class="card-title">Crear requerimiento</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-content collapse show">
                                <form id="form_crear_requerimiento" class="form" action="{{ route('crear_requerimientos') }}" method="POST">
                                    @csrf
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="nombre">Nombre (*)</label>
                                                    <input autocomplete="off" type="text" class="form-control border-primary @error('nombre') is-invalid @enderror" name="nombre" id="nombre">
                                                    @error('nombre')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="detalle">Detalle (*)</label>
                                                    <textarea class="form-control border-primary @error('detalle') is-invalid @enderror" name="detalle" id="detalle" cols="30" rows="3"></textarea>
                                                    @error('detalle')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="fecha_finalizacion">Fecha finalización</label>
                                                    <input autocomplete="off" type="date" class="form-control border-primary @error('fecha_finalizacion') is-invalid @enderror" name="fecha_finalizacion" id="fecha_finalizacion">
                                                    @error('fecha_finalizacion')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_tipo_requerimiento">Tipo de requerimiento (*)</label>
                                                    <select class="form-control border-primary @error('id_tipo_requerimiento') is-invalid @enderror" name="id_tipo_requerimiento" id="id_tipo_requerimiento">
                                                        <option value="">Seleccion el tipo de requerimiento</option>
                                                        @foreach ($tipos_requerimientos as $item)
                                                            <option value="{{ $item->id_tipo_requerimiento }}">{{ $item->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_tipo_requerimiento')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_proceso">Proceso (*)</label>
                                                    <select class="form-control border-primary @error('id_proceso') is-invalid @enderror" name="id_proceso" id="id_proceso">
                                                        <option value="">Seleccion el proceso</option>
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
                                    </div>
                                    <hr>
                                    <div class="fomr-actions text-center">
                                        <a href="{{ route('listar_requerimientos') }}" class="btn btn-warning mr-1">
                                            <i class="la la-close"></i>
                                            Cancelar
                                        </a>
                                        <button id="guardar_form" type="submit" class="btn btn-primary">
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
<script src="{{ asset('moment_js/moment.js') }}"></script>
<script src="{{ asset('sweet_alert2/sweetalert2@11.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#form_crear_requerimiento").validate({
            rules: {
                nombre : {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                detalle : {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                fecha_finalizacion : {
                    required: true,
                    date: true
                },
                id_proceso : {
                    required: true
                },
                id_tipo_requerimiento : {
                    required: true
                }
            },
            messages : {
                nombre : {
                    required: "El nombre del requerimiento es obligatorio",
                    minlength: "El nombre debe contener minimo 3 caracteres",
                    maxlength: "El nombre no debe superar los 100 caracteres"
                },
                detalle : {
                    required: "El detalle del requerimiento es obligatorio",
                    minlength: "El detalle debe contener minimo 3 caracteres",
                    maxlength: "El detalle no debe superar los 255 caracteres"
                },
                fecha_finalizacion : {
                    required: "La fecha de finalizacion es obligatoria",
                    date: "Ingrese un formato de fecha valido"
                },
                id_proceso : {
                    required: "El proceso es obligatorio"
                },
                id_tipo_requerimiento : {
                    required: "El tipo de requerimiento es obligatorio"
                }
            }
        });

        $('#fecha_finalizacion').on("blur", function(){
            let fecha_finalizacion = $('#fecha_finalizacion').val();
            let fecha_actual = 	moment().format('YYYY-MM-DD');
            if(fecha_actual >= fecha_finalizacion){
                Swal.fire({
                    icon: 'error',
                    title: '¡Fecha incorrecta!',
                    text: 'La fecha de finalizacion debe ser un dia mayor a la fecha actual.',
                    footer: '<strong>Nota: </strong><p>Actualiza la fecha y da click fuera del campo de texto</p>'
                });
                $('#guardar_form').hide("slow");
            }else{
                $('#guardar_form').show("slow");
            }
        });
    });
</script>
@endsection