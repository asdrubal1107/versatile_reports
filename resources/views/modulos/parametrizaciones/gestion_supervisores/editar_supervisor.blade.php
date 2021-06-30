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
                <h3 class="content-header-title mb-0">Gestion Supervisores</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_supervisores') }}">Listar supervisores</a>
                            </li>
                            <li class="breadcrumb-item active">Editar supervisores
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
                            <h4 class="card-title">Editar supervisor</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-content collapse show">
                                <form id="form_editar_supervisor" class="form" action="{{ route('editar_supervisores') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="correo_anterior" id="correo_anterior" value="{{ $supervisor->correo }}">
                                    <input type="hidden" name="documento_anterior" id="documento_anterior" value="{{ $supervisor->documento }}">
                                    <input type="hidden" name="id_supervisor" id="id_supervisor" value="{{ $supervisor->id_supervisor }}">
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="tipo_documento">Tipo Documento (*)</label>
                                                    <select name="tipo_documento" id="tipo_documento" class="form-control border-primary @error('documento') is-invalid @enderror">
                                                        <option value="">Seleccione un tipo de documento</option>
                                                        <option value="CC" {{ $supervisor->tipo_documento == 'CC' ? 'selected' : '' }}>Cedula Ciudadania</option>
                                                        <option value="CE" {{ $supervisor->tipo_documento == 'CE' ? 'selected' : '' }}>Cedula Extranjera</option>
                                                    </select>
                                                    @error('tipo_documento')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="documento">Documento (*)</label>
                                                    <input type="text" name="documento" value="{{ $supervisor->documento }}" class="form-control border-primary @error('documento') is-invalid @enderror" id="documento">
                                                    @error('documento')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="nombre">Nombre (*)</label>
                                                    <input type="text" value="{{ $supervisor->nombre }}" class="form-control border-primary @error('nombre') is-invalid @enderror" name="nombre" id="nombre">
                                                    @error('nombre')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="primer_apellido">Primer apellido (*)</label>
                                                    <input type="text" value="{{ $supervisor->primer_apellido }}" class="form-control border-primary @error('primer_apellido') is-invalid @enderror" name="primer_apellido" id="primer_apellido">
                                                    @error('primer_apellido')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="segundo_apellido">Segundo apellido <span style="font-size: 11px">(Opcional)</span></label>
                                                    <input type="text" value="{{ $supervisor->segundo_apellido }}" class="form-control border-primary @error('segundo_apellido') is-invalid @enderror" name="segundo_apellido" id="segundo_apellido">
                                                    @error('segundo_apellido')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="cargo">Cargo (*)</label>
                                                    <input type="text" value="{{ $supervisor->cargo }}" class="form-control border-primary @error('cargo') is-invalid @enderror" name="cargo" id="cargo">
                                                    @error('cargo')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="dropdown-divider"></div>
                                                <div class="form-grup"><label>Informacion de acceso a la aplicacion</label></div>
                                                <div class="form-group">
                                                    <label for="correo">Correo electronico (*)</label>
                                                    <input autocomplete="off" value="{{ $supervisor->correo }}" type="text" class="form-control border-primary @error('correo') is-invalid @enderror" name="correo" id="correo">
                                                    @error('correo')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Contraseña</label>
                                                    <input autocomplete="off" type="text" placeholder="Contraseña" class="form-control border-primary @error('password') is-invalid @enderror" name="password" id="password">
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Rol: </label>
                                                    <input class="form-control border-primary" type="text" readonly value="Supervisor">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="fomr-actions text-center">
                                        <a href="{{ route('listar_supervisores') }}" class="btn btn-warning mr-1">
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
        $("#form_editar_supervisor").validate({
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
                cargo : {
                    required: true,
                    minlength: 3,
                    maxlength: 30
                },
                password : {
                    minlength: 8,
                    maxlength: 20
                },
                correo : {
                    required: true,
                    email: true
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
                    required: "Nombre del supervisor es obligatorio",
                    minlength: "El nombre debe contener por lo menos 3 caracteres",
                    maxlength: "El nombre debe contener como maximo 40 caracteres"
                },
                primer_apellido: {
                    required: "Primer apellido del supervisor es obligatorio",
                    minlength: "El apellido debe contener por lo menos 3 caracteres",
                    maxlength: "El apellido debe contener como maximo 30 caracteres"
                },
                segundo_apellido: {
                    minlength: "El apellido debe contener por lo menos 3 caracteres",
                    maxlength: "El apellido debe contener como maximo 30 caracteres"
                },
                cargo: {
                    required: "Cargo del supervisor es obligatorio",
                    minlength: "El cargo debe contener por lo menos 3 caracteres",
                    maxlength: "El cargo debe contener como maximo 30 caracteres"
                },
                password : {
                    minlength: "La contraseña debe tener como minimo 8 caracteres",
                    maxlength: "La contraseña debe tener como maximo 20 caracteres"
                },
                correo : {
                    required: "El correo es obligatorio",
                    email: "Ingrese un formato valido, ejemplo@ejemplo.com"
                }
            }
        });
    });
</script>
@endsection