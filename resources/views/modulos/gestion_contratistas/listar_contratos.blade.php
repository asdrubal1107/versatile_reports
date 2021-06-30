@extends('layouts.principal')

@section('style')
    <style>
        .page-item.active .page-link {
            color: #fff !important;
            background-color: #E96928 !important;
        }
    </style>
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
                            <li class="breadcrumb-item active">Lista contratos
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
                            <h4 class="card-title">Lista contratos - {{ $contratista->nombre . ' ' . $contratista->primer_apellido . ' ' . $contratista->segundo_apellido }}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li>
                                        <a href="{{ route('view_crear_contratos', ['id' => $contratista->id_contratista]) }}" class="btn btn-versatile_reports">
                                            <i class="ft-plus-square"></i> Nuevo
                                        </a>
                                    </li>
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
                                <div id="validation-message"></div>
                                <div class="table-responsive">
                                    <table id="contratos" style="width: 100%;" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">Contratista</th>
                                                <th style="width: 15%;">Nombre contratista</th>
                                                <th style="width: 15%;">Numero contrato</th>
                                                <th style="width: 20%;">Fecha inicio</th>
                                                <th style="width: 20%;">Fecha fin</th>
                                                <th style="width: 10%;">Estado</th>
                                                <th style="width: 25%;">Opciones</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
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
<script src="{{ asset('sweet_alert2/sweetalert2@11.js') }}"></script>

<script>
    let id_contratista = {{ $contratista->id_contratista }}
    $('#contratos').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/contratistas/contratos/ratsil/"+id_contratista,
        columns: [
            {data: 'documento', name: 'documento'},
            {data: 'nombre', name: 'nombre'},
            {data: 'numero_contrato', name: 'numero_contrato'},
            {data: 'fecha_inicio', name: 'fecha_inicio'},
            {data: 'fecha_fin', name: 'fecha_fin'},
            {data: 'estado', name: 'estado'},
            {data: 'Opciones', name: 'Opciones', orderable: false, searchable: false}
        ],
        language : {
            "processing": "Procesando...",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "infoThousands": ",",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "info": "Mostrando de _START_ a _END_ de _TOTAL_ entradas",
            "lengthMenu": "Mostrar <select>"+
                        "<option value='10'>10</option>"+
                        "<option value='25'>25</option>"+
                        "<option value='50'>50</option>"+
                        "<option value='-1'>Todos</option>"+
                        "</select> registros"
        }
    });

    // function asignar_contrato(id_contrato) {
    // Swal.fire({
    //     title: "¿Estas seguro de asignar el contrato?",
    //     icon: "info",
    //     showCancelButton: true,
    //     confirmButtonColor: "#3085d6",
    //     cancelButtonColor: "#d33",
    //     confirmButtonText: "Si, asignar!",
    //     cancelButtonText: "Cancelar",
    // }).then((result) => {
    //     if (result.isConfirmed) {
    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });
    //         $.ajax({
    //             url: "{{ url('/contratistas/contratos/cambiar/estado/"+id_contrato+"/1') }}", //Peticion asincrona al controlador
    //             method: "POST",
    //             success: function (response) {
    //                 $('.alert').show();
    //                 $('.alert').html(response.success);
    //             },
    //         });
    //     }
    // });
    // }
</script>
    
@endsection