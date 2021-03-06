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
                <h3 class="content-header-title mb-0">Gestion de obligaciones</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_obligaciones') }}">Listar obligaciones</a>
                            </li>
                            <li class="breadcrumb-item active">Editar obligacion
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
                            <h4 class="card-title">Editar obligación</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-content collapse show">
                                <form id="form_editar_obligaciones" class="form" action="{{ route('editar_obligaciones') }}" method="post">
                                    <input type="hidden" name="id_obligacion" id="id_obligacion" value="{{ $obligacion->id_obligacion }}">
                                    @csrf
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="detalle">Detalle obligacion (*)</label>
                                                    <input value="{{ $obligacion->detalle }}" autocomplete="off" type="text" class="form-control border-primary @error('detalle') is-invalid @enderror" name="detalle" id="detalle">
                                                    @error('detalle')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_proceso">Proceso (*)</label>
                                                    <select class="form-control border-primary @error('id_proceso') is-invalid @enderror" name="id_proceso" id="id_proceso">
                                                        <option value="">Seleccion el proceso</option>
                                                        @foreach ($procesos as $item)
                                                            <option {{ $item->id_proceso == $obligacion->id_proceso ? 'selected' : '' }} value="{{ $item->id_proceso }}">{{ $item->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_proceso')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="fecha_vencimiento">Fecha vencimiento (*)</label>
                                                    <input value="{{ date('Y-m-d', strtotime($obligacion->fecha_vencimiento)) }}" type="date" id="fecha_vencimiento" name="fecha_vencimiento" class="form-control border-primary @error('fecha_vencimiento') is-invalid @enderror">
                                                    @error('fecha_vencimiento')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="fomr-actions text-center">
                                        <a href="{{ route('listar_obligaciones') }}" class="btn btn-warning mr-1">
                                            <i class="la la-close"></i>
                                            Cancelar
                                        </a>
                                        <button type="submit" id="guardar_form" class="btn btn-primary">
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
        $("#form_editar_obligaciones").validate({
            rules: {
                detalle : {
                  required: true,
                  minlength: 3
                },
                id_proceso : {
                  required: true,
                },
                fecha_vencimiento : {
                    required: true,
                    date: true
                }
            },
            messages : {
                detalle : {
                  required: "Este campo es obligatorio",
                  minlength: "El detalle debe contener minimo 3 caracteres"
                },
                id_proceso : {
                  required: "Este campo es obligatorio",
                },
                fecha_vencimiento : {
                    required: "Este campo es obligatorio",
                    date: "Formato de fecha no valido"
                }
            }
        });
        $('#fecha_vencimiento').on("blur", function(){
            let fecha_finalizacion = $('#fecha_vencimiento').val();
            let fecha_actual = 	moment().format('YYYY-MM-DD');
            if(fecha_actual >= fecha_finalizacion){
                Swal.fire({
                    icon: 'error',
                    title: '¡Fecha incorrecta!',
                    text: 'La fecha de vencimiento debe ser un dia mayor a la fecha actual.',
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