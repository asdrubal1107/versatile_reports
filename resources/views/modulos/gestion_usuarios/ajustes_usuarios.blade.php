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
                <h3 class="content-header-title mb-0">Ajustes de usuario</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            </li>
                            <li class="breadcrumb-item active">Ajustes de usuario
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
                            <h4 class="card-title">Ajustes de usuario</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-content collapse show">
                                @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        {{Session::get('success')}}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->all() as $item)
                                            {{$item}}
                                        @endforeach
                                    </div>
                                @endif
                                <form id="form_ajustes_usuarios" class="form" action="{{ route('ajustes_usuario') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_usuario" id="id_usuario" value="{{ $usuario->id_usuario }}">
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="contraseña">Contraseña (*)</label>
                                                    <input autocomplete="off" type="password" class="form-control border-primary @error('contraseña') is-invalid @enderror" name="contraseña" id="contraseña">
                                                    @error('contraseña')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="contraseña_confirmation">Confirmar contraseña (*)</label>
                                                    <input autocomplete="off" type="password" class="form-control border-primary @error('contraseña_confirmation') is-invalid @enderror" name="contraseña_confirmation" id="contraseña_confirmation">
                                                    @error('contraseña_confirmation')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="fomr-actions text-center">
                                        <a href="{{ route('dashboard') }}" class="btn btn-warning mr-1">
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
        $("#form_ajustes_usuarios").validate({
            rules: {
                contraseña : {
                  required: true,
                  minlength: 8,
                  maxlength: 20
                },
                contraseña_confirmation : {
                    required: true,
                    equalTo: '#contraseña'
                }
            },
            messages : {
                contraseña : {
                  required: "Campo obligatorio",
                  minlength: "La contraseña debe ser minimo de 8 caracteres",
                  maxlength: "La contraseña debe ser maximo de 20 caracteres"
                },
                contraseña_confirmation : {
                    required: "Campo obligatorio",
                    equalTo: "Las contraseñas no coinciden"
                }
            }
        });
  });
</script>
@endsection