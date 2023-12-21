<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>SolicitudUnidad</title>
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

        .txt_rojo {}

        .img_celda img {
            width: 45px;
        }
    </style>
</head>

<body>
    @inject('configuracion', 'App\Models\Configuracion')
    <div class="encabezado">
        <div class="logo">
            <img src="{{ asset('imgs/' . $configuracion->first()->logo) }}">
        </div>
        <h2 class="titulo">
            {{ $configuracion->first()->nombre_sistema }}
        </h2>
        <h4 class="texto">LISTA DE SOLICITUDES</h4>
        <h4 class="fecha">Expedido: {{ date('d-m-Y') }}</h4>
    </div>
    <table border="1">
        <thead class="bg-principal">
            <tr>
                <th width="5%">CÓDIGO</th>
                <th>UNIDAD</th>
                <th>DESCRIPCIÓN DEL VIAJE</th>
                <th>FECHA SOLICITUD</th>
                <th>NRO. HOJA DE RUTA</th>
                <th>CONDUCTOR</th>
                <th>VEHÍCULO</th>
                <th>COMBUSTIBLE (LTS.)</th>
                <th>OBSERVACIÓN</th>
                <th width="9%">FECHA DE REGISTRO</th>
            </tr>
        </thead>
        <tbody>
            @php
                $cont = 1;
            @endphp
            @foreach ($unidad_solicitantes as $value)
                <tr>
                    <td class="centreado">{{ $value->codigo }}</td>
                    <td class="centreado">{{ $value->unidad->nombre }}</td>
                    <td class="centreado">{{ $value->descripcion_viaje }}</td>
                    <td class="centreado">{{ $value->fecha_solicitud_t }}</td>
                    <td class="centreado">{{ $value->nro_hoja_ruta }}</td>
                    <td class="centreado">
                        @if (count($value->solicitud_combustibles) > 0 && $value->conductor == 1)
                            <ul style="padding-left:10px; list-style:none;">
                                @foreach ($value->solicitud_combustibles as $sc)
                                    <li>{{ $sc->user->full_name }}</li>
                                @endforeach
                            </ul>
                        @else
                            S/A
                        @endif
                    </td>
                    <td class="centreado">
                        @if (count($value->solicitud_combustibles) > 0 && $value->vehiculo == 1)
                            <ul style="padding-left:10px; list-style:none;">
                                @foreach ($value->solicitud_combustibles as $sc)
                                    <li>{{ $sc->vehiculo->full_name }}</li>
                                @endforeach
                            </ul>
                        @else
                            S/A
                        @endif
                    </td>
                    <td class="centreado">
                        @if (count($value->solicitud_combustibles) > 0 && $value->combustible == 1)
                            <ul style="padding-left:10px; list-style:none;">
                                @foreach ($value->solicitud_combustibles as $sc)
                                    <li>{{ $sc->combustible }}</li>
                                @endforeach
                            </ul>
                        @else
                            S/A
                        @endif
                    </td>
                    <td class="centreado">{{ $value->observacion }}</td>
                    <td class="centreado">{{ $value->fecha_registro }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
