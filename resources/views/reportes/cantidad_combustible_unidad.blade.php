<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>CantidadCombustibleUnidad</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 1.5cm;
            margin-bottom: 0.3cm;
            margin-left: 0.3cm;
            margin-right: 0.3cm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 20px;
            page-break-before: avoid;
        }

        table thead tr th,
        tbody tr td {
            padding: 3px;
            word-wrap: break-word;
        }

        table thead tr th {
            font-size: 7pt;
        }

        table tbody tr td {
            font-size: 6pt;
        }


        .encabezado {
            width: 100%;
        }

        .logo img {
            position: absolute;
            height: 120px;
            top: -20px;
            left: 10px;
        }

        h2.titulo {
            width: 450px;
            margin: auto;
            margin-top: 0PX;
            margin-bottom: 15px;
            text-align: center;
            font-size: 14pt;
        }

        .texto {
            width: 250px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: bold;
            font-size: 1.1em;
        }

        .fecha {
            width: 250px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: normal;
            font-size: 0.85em;
        }

        .total {
            text-align: right;
            padding-right: 15px;
            font-weight: bold;
        }

        table {
            width: 100%;
        }

        table thead {
            background: rgb(236, 236, 236)
        }

        tr {
            page-break-inside: avoid !important;
        }

        .centreado {
            padding-left: 0px;
            text-align: center;
        }

        .datos {
            margin-left: 15px;
            border-top: solid 1px;
            border-collapse: collapse;
            width: 250px;
        }

        .txt {
            font-weight: bold;
            text-align: right;
            padding-right: 5px;
        }

        .txt_center {
            font-weight: bold;
            text-align: center;
        }

        .cumplimiento {
            position: absolute;
            width: 150px;
            right: 0px;
            top: 86px;
        }

        .b_top {
            border-top: solid 1px black;
        }

        .gray {
            background: rgb(202, 202, 202);
        }

        .bg-principal {
            background: #161717;
            color: white;
        }

        .bold {
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .text-lg {
            font-size: 9pt;
        }

        .img_celda img {
            width: 45px;
        }

        .salto_pagina {
            page-break-after: always;
        }

        .nombre_unidad {
            text-align: center;
            font-size: 10pt;
        }
    </style>
</head>

<body>
    @inject('configuracion', 'App\Models\Configuracion')
    @php
        $cont = 0;
    @endphp
    @foreach ($unidads as $unidad)
        <div class="encabezado">
            <div class="logo">
                <img src="{{ asset('imgs/' . $configuracion->first()->logo) }}">
            </div>
            <h2 class="titulo">
                {{ $configuracion->first()->nombre_sistema }}
            </h2>
            <h4 class="texto">CANTIDAD DE COMBUSTIBLE SOLICITADO POR UNIDAD</h4>
            <h4 class="fecha">Expedido: {{ date('d-m-Y') }}</h4>
        </div>
        <h4 class="text-lg bold nombre_unidad">{{ $unidad->nombre }}</h4>
        <table border="1">
            <thead class="bg-principal">
                <tr>
                    <th width="8%">CÓDIGO</th>
                    <th>CONDUCTOR</th>
                    <th>VEHÍCULO</th>
                    <th>NRO. VALE</th>
                    <th>FECHA DE ENTREGA</th>
                    <th>OBSERVACIÓN</th>
                    <th width="9%">FECHA DE REGISTRO</th>
                    <th>COMBUSTIBLE LTS.</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $solicitud_combustibles = App\Models\SolicitudCombustible::select('solicitud_combustibles.*')
                        ->join('unidad_solicitantes', 'unidad_solicitantes.id', '=', 'solicitud_combustibles.unidad_solicitante_id')
                        ->where('unidad_solicitantes.unidad_id', $unidad->id)
                        ->get();
                    if ($filtro == 'Rango de fechas' && $fecha_ini != '' && $fecha_fin != '') {
                        $solicitud_combustibles = App\Models\SolicitudCombustible::select('solicitud_combustibles.*')
                            ->join('unidad_solicitantes', 'unidad_solicitantes.id', '=', 'solicitud_combustibles.unidad_solicitante_id')
                            ->where('unidad_solicitantes.unidad_id', $unidad->id)
                            ->whereBetween('solicitud_combustibles.fecha_registro', [$fecha_ini, $fecha_fin])
                            ->get();
                    }

                    $total_combustible = 0;
                @endphp
                @foreach ($solicitud_combustibles as $value)
                    @php
                        $total_combustible += (float) $value->combustible ? $value->combustible : 0;
                    @endphp
                    <tr>
                        <td class="centreado">{{ $value->unidad_solicitante->codigo }}</td>
                        <td class="centreado">{{ $value->user ? $value->user->full_name : 'S/A' }}</td>
                        <td class="centreado">{{ $value->vehiculo ? $value->vehiculo->full_name : 'S/A' }}</td>
                        <td class="centreado">{{ $value->nro_vale }}</td>
                        <td class="centreado">{{ $value->fecha_entrega_t }}</td>
                        <td class="centreado">{{ $value->observacion }}</td>
                        <td class="centreado">{{ $value->fecha_registro }}</td>
                        <td class="centreado">{{ $value->combustible ? $value->combustible : 'S/A' }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="text-right text-lg bold" colspan="7">TOTAL</td>
                    <td class="text-lg centreado bold">{{ $total_combustible }}</td>
                </tr>
            </tbody>
        </table>
        @php
            $cont++;
        @endphp
        @if ($cont < count($unidads))
            <div class="salto_pagina"></div>
        @endif
    @endforeach
</body>

</html>
