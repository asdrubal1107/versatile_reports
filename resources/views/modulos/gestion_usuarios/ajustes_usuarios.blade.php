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
                                                    <label for="contrase??a">Contrase??a (*)</label>
                                                    <input autocomplete="off" type="password" class="form-control border-primary @error('contrase??a') is-invalid @enderror" name="contrase??a" id="contrase??a">
                                                    @error('contrase??a')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="contrase??a_confirmation">Confirmar contrase??a (*)</label>
                                                    <input autocomplete="off" type="password" class="form-control border-primary @error('contrase??a_confirmation') is-invalid @enderror" name="contrase??a_confirmation" id="contrase??a_confirmation">
                                                    @error('contrase??a_confirmation')
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
                contrase??a : {
                  required: true,
                  minlength: 8,
                  maxlength: 20
                },
                contrase??a_confirmation : {
                    required: true,
                    equalTo: '#contrase??a'
                }
            },
            messages : {
                contrase??a : {
                  required: "Campo obligatorio",
                  minlength: "La contrase??a debe ser minimo de 8 caracteres",
                  maxlength: "La contrase??a debe ser maximo de 20 caracteres"
                },
                contrase??a_confirmation : {
                    required: "Campo obligatorio",
                    equalTo: "Las contrase??as no coinciden"
                }
            }
        });
  });
</script>
@endsection