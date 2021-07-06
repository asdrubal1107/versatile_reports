<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contratistas</title>
    <style>
        body{
            margin: 0px;
            padding: 0px;
        }
        .page-break{
            page-break-before: always;
        }
        .titulo{
            border: 2px solid #aaa;
            border-radius: 10px;
            padding: 10px;
        }
        .titulo h1 {
            text-align: center;
        }
        .titulo p{
            text-align: right;
        }
        .tabla{
            width: 100%;
            border: 1px solid #aaa;
            border-radius: 10px;
            padding: 10px;
            margin-top: 20px;
        }
        .table {
            border-collapse: collapse;
            width: 100%;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="titulo">
        <h1>Reporte contratistas</h1>
        <p>Se busco por {{ $input["criterio"] == "fecha_fin" ? 'fecha fin' : 'fecha inicio' }}, fechas: {{ date('Y-m-d', strtotime($input["fecha_inicio"])) }} hasta {{ date('Y-m-d', strtotime($input["fecha_fin"])) }}.</p>
    </div>
    <div class="tabla">
        <table class="table" border="1">
            <thead>
                <tr>
                    <th>Numero contrato</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Documento</th>
                    <th>Correo sena</th>
                    <th>Celular</th>
                    <th style="width: 17%;">Fecha contrato</th>
                    <th>Valor <span style="font-size: 13px">(Anual)</span></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contratistas as $item)
                    <tr>
                        <td>{{ $item->numero_contrato }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->primer_apellido.' '.$item->segundo_apellido }}</td>
                        <td>{{ $item->documento }}</td>
                        <td>{{ $item->correo_sena }}</td>
                        <td>{{ $item->celular_uno }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->fecha_inicio)).' - '.date('d/m/Y', strtotime($item->fecha_fin)) }}</td>
                        <td>${{ number_format($item->valor, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- <div class="page-break"></div> SALTO PAGINA --}}
</body>
</html>