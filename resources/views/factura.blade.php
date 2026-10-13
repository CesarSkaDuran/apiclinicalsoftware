<style type="text/css">
    table {

        width: 100%;

        border-bottom: 1px solid #DDD;

        border-collapse: collapse !important;

        border-radius: 1px;

        margin-top: 20px;

        margin-bottom: 20px;

    }

    th,
    td {
        padding: 0 8px !important;
        height: 28px !important;
        min-height: 28px !important;
    }

    .table>thead>tr>th {
        height: 30px !important;
    }

    .table1 {

        margin-top: 20px;

    }

    .table2 {

        margin-bottom: 20px;
        margin-top: 5px;

    }

    .b-logo {
        width: 132px;
        float: left;
        top: 12px;
        position: relative;
    }

    .b-header {
        font-weight: 500;
        font-size: 18px;
        letter-spacing: 0.6px;
        color: black !important;
        margin-top: 22px;
        display: inline-block;
        margin-bottom: 0;
        margin-left: 12px;
    }

    .b-p {
        text-align: center;

            {
                {
                -- display: table;
                --
            }
        }

        font-weight: 500;
        font-size: 10px;
        margin-top: 6px;
        letter-spacing: 0.3px;
        line-height: 1.5;
        left: 6px;
        position: relative;
    }

    .b-p2 {
        text-align: center;
        font-size: 10px;
        margin-top: 28px;
    }

    .p-table {
        border-collapse: separate !important;
        border-spacing: 0;
        border: 1px solid #777;
        border-radius: 6px;
        -moz-border-radius: 5px;
        margin: 0;
    }

    .p-tableheader {
        font-family: impact;
        text-align: center;
        background-color: #eee !important;
    }

    .p-tabledate {
        text-align: center;
        font-size: 14px;
    }

    .p-impact {
        font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        margin-right: 4px;
        color: #555 !important;
    }

    .p-rightline {
        border-right: 1px solid #777 !important;
    }

    .p-topline {
        border-top: 1px solid #777 !important;
    }

    .p-bottomline {
        border-bottom: 1px solid #777 !important;
    }

    .p-original {
        display: inline;
        font-size: 20px;
        color: red !important;
        letter-spacing: 1.1px;
        font-weight: 500;
        position: relative;
        left: 8px;
    }

    .p-optionalContainer {
        width: 80%;
        min-width: 500px;
        position: relative;
        top: -84px;
        height: 0px;
    }

    .p-lettercontainer {
        padding: 8px;
        border: 1px solid #777;
        border-radius: 4px;
        margin-top: 10px;
        margin-right: 22px;
    }

    .p-recibed {
        display: inline-block;
        float: right;
        position: relative;
        left: -100px;
        top: 14px;
        text-align: center;
    }

    .bold {

        color: #333;

    }

    pre {

        color: #555;

    }

    footer {

        text-align: center;

    }

    .w_50 {

        display: inline-block;

        width: 50%;

        text-align: center;

    }

    .p-datetitle {
        font-family: impact;
        font-size: 14px;
    }

    .line {

        border-bottom: 1px solid #333;

        margin: 0 auto;

        width: 50%;

        display: block;

    }

    .page-header {
        display: none;
    }

    * {
        font-size: 12px;
        font-family: 'Times New Roman';
    }

    td,
    th,
    tr,
    table {
        border-top: 1px solid black;
        border-collapse: collapse;
    }

    td.producto,
    th.producto {
        width: 75px;
        max-width: 75px;
    }

    td.cantidad,
    th.cantidad {
        width: 40px;
        max-width: 40px;
        word-break: break-all;
    }

    td.precio,
    th.precio {
        width: 40px;
        max-width: 40px;
        word-break: break-all;
    }

    .centrado {
        text-align: center;
        align-content: center;
    }

    .ticket {
        width: 220px;
        max-width: 220px;
    }

    img {
        max-width: inherit;
        width: inherit;
    }

    @media print {

        .no-print,
        .no-print * {
            display: none !important;
        }
    }

</style>


<head>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<div style="font-size: 13px" class="ticket">
    {{--  <img height="70px" width="70px" src="{{asset('img/logoBoxBlanco.png')}}" class="b-logo" alt=""> --}}

    <div class="centrado">
        <h4 class="b-header">{{$data['doctor_name']}}</h4>
        <p style="font-size: 12px" class="b-p">
            {{--  NIT: 1111111111-1<br>  --}}
            Dirección: {!!$data['address']!!}<br>


        </p>
    </div>
    {{--  Remitido: {{ $factura->agendador_id }}<br> --}}
    @if(isset($tratamiento))
    Historia Clínica:{{$data['record']}}<br>
     Remisión N° {{$data['idTratamiento']}}  <BR>
     Documento: {{$data['document']}}<br>
    @endif
    @if(isset($servicio))
    Remisión N° {{ $cuenta->id }}  <BR>
    Documento: {{$data['documento']}}<br>
    @endif
    Fecha: {{$data['date']}}<br>
   
    Nombre: {{$data['name']}}<br>
    @if(isset($tratamiento))
    Género: {{$data['gender']}}<br>
    Edad: </strong> {{$data['age'] }}
    @endif
    @if(isset($servicio))
    <table>
        <thead>
            <tr>
                <th style="text-align: inherit;" class="cantidad">Concepto</th>
                <th class="precio">Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicio as $item)
            <tr>
                <td class="cantidad">{{$item->nombre}}</td>
                <td class="precio">${{number_format($item->valor)}}</td>
            </tr>
            @endforeach
            <tr>
                {{--  <td class="cantidad"></td>  --}}
                <td class="producto">TOTAL</td>
                <td class="precio">${{number_format($totalComision)}}</td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>

                <th style="font-size: 13px; text-align:left" scope="col">Observacion</th>


            </tr>
        </thead>
        <tr>

            <td>{{$data['obs']}}</td>

        </tr>
        </tbody>
    </table>
    @endif
    @if(isset($tratamiento))
    <table>
        <thead>
            <tr>
                <th class="cantidad">Concepto</th>
                <th class="producto">Pieza</th>
                <th class="precio">Valor</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($tratamiento as $item)
            <tr>
                <td class="cantidad">{{$item->procedimiento}}</td>
                <td class="producto"> {{$item->pieza}}
                <td class="precio">${{number_format($item->valor)}}</td>
            </tr>

            @endforeach
            <tr>
                <td class="cantidad"></td>
                <td class="producto">TOTAL</td>
                <td class="precio">${{number_format($totalComision)}}</td>
            </tr>

        </tbody>
    </table>
    @endif
    {{--  <span><strong >Observación:</strong> {{ $factura->observacion }}</span> --}}
    <p class="centrado">¡GRACIAS POR SU COMPRA!
        {{--  <br>parzibyte.me</p>  --}}
</div>

<p style="color:transparent !important;">Esta Remisión de venta se asimila para todos sus efectos a un Título valor de
    acuerdo a la Ley 1231 de julio 17 del 2008</p>
<div style="margin:0;text-align:center;position:relative;top:-40px;">
    <!-- www.boxmedia.com.co -->
    <br>Esta Remisión de venta se asimila para todos sus efectos a un Título valor de acuerdo a la Ley 1231 de julio 17
    del 2008

</div>

<input type="hidden" name="imprimir" value="Imprimir" onclick="window.print();">
<script>
    window.print();

</script>
<script src="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js')}}"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>
