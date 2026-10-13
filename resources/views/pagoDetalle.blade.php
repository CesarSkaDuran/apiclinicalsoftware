<html>
<head>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }
 
        body {
            margin: 1cm 1cm 1cm;
            font-family: Arial;
        }
        table {
            width: 100%;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

    </style>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<header>
    <br>
    <table >
        <tr>
            <td style="text-align: center;" width="30%">
               <img src="{{$data['img_url']}}"  height="50px" alt="logo">
            </td>
            <td style="text-align: center; " width="33%">
                <ul>
                <li style="font-size: 18px; text-align: center;  color: #02027b;" > {{$data['doctor_name']}} </li> 
                <li style="font-size: 10px; text-align: center; " >{{$data['specialization']}} </li> 
                <li style="font-size: 10px; text-align: center;" >{{$data['dphone']}} </li>  
                <li style="font-size: 10px; text-align: center;" > {!!$data['experience']!!}</li> 
                <li style="font-size: 10px; text-align: center; " >{{$data['address']}}   </li> 
                  
                </ul>
            </td>
            <td style="text-align: center;" width="33%">
                <div style="text-align: left;display:inline-block;">
                     <ul>
                        {{--  <strong><li style="font-size: 13px;" >{{$data['message']}}</li></strong>  --}}
                    </ul>
                    
                    <ul>
                          <div style="text-align: center">
                              <li><button class="btn btn-info text-white no-print"><a href="{{route('cuentaPresupuestoPost', $cuenta->id )}}">Factura post</a></button></li>
        <h4 style="color: #02027b;">RECIBO N°  {{$cuenta->id}}</h4>
    </div>
                        {{--  <li style="font-size: 13px;" ><strong>RECIBO N° : </strong> {{$cuenta->id}}</li>  --}}
                         <li style="font-size: 13px;" ><strong>Fecha: </strong> {{$data['date']}}</li>
                    </ul>
                </div>
            </td>
        </tr>
    </table>
</header>
 
<main>
    {{--  <div style="margin-left: 225px;">
       <p>Fecha {{$data['fechaGenerada']}}</p>
    </div>  --}}
      
  

 <div style="margin:30px;">
     
    <table>
        <tr style="">
            <td width="33%">
                <div style="text-align: left;display:inline-block;height:15px;">
                    <ul>
                         <li style="font-size: 13px;" ><strong>Cliente: </strong>{{$data['name']}}</li>
                        
                       
                        {{--  <li style="font-size: 13px;" ><strong>N° EMPRESA: </strong>{{$data['afiliacion']}}</li>  --}}
                    </ul>
                </div>
            </td>
            <td width="33%" style="text-align: left;">
                <div style="text-align: left;display:inline-block;height:15px;">
                    <ul>
                        {{--  <li style="font-size: 13px;" ><strong>Ciudad: </strong> {{$data['ciudad'] }}</li>  --}}
                       <li style="font-size: 13px;" ><strong>Nit/Cc: </strong>{{$data['documento']}} @if(isset($data['dv']))-@endif{{$data['dv']}}</li>
                                    

                    </ul>
                </div>
            </td>
    <td width="33%">
      <ul>
          @if($cuenta->status == 1)
       <h6 style="color: green;">{{$cuenta->status == 1 ? 'PAGADO' : 'PENDIENTE'}}</h6>
        @else
         <h6 style="color: red;">{{$cuenta->status == 1 ? 'PAGADO' : 'PENDIENTE'}}</h6>
         @endif
    </ul>
  </td>
        </tr>
        <tr>
            <td width="50%">
                <div style="text-align: left;display:inline-block;">
                    <ul>
                         <li style="font-size: 13px;" ><strong>Dirección: </strong>{{$data['direccion']}}</li>
                        
                       
                        {{--  <li style="font-size: 13px;" ><strong>N° EMPRESA: </strong>{{$data['afiliacion']}}</li>  --}}
                    </ul>
                </div>
            </td>
            <td width="50%" style="text-align: start;">
                <div style="text-align: left;display:inline-block;">
                    <ul>
                        {{--  <li style="font-size: 13px;" ><strong>Ciudad: </strong> {{$data['ciudad'] }}</li>  --}}
                       <li style=" font-size: 13px;"> <strong>Telefono:</strong> {{$data['telefono']}} </li>
                                    

                    </ul>
                </div>
            </td>

  
        </tr>
    </table>

<table class="table table-bordered" style="margin-bottom: 0;">
  <thead>
    <tr style="background: #f4f4f4;">
      {{--  <th style="font-size: 13px;text-transform: uppercase;"scope="col">Id</th>  --}}
      <th style="font-size: 13px; text-align:center"scope="col">Concepto</th>
      {{--  <th style="font-size: 13px; text-align:center"scope="col">Paquete</th>  --}}
      {{--  <th style="font-size: 13px; text-align:center"scope="col">Unidad</th>  --}}
      {{--  <th style="font-size: 13px; text-align:center"scope="col">Cantidad</th>  --}}
      <th style="font-size: 13px; text-align:center"scope="col">Valor</th>
    </tr>
  </thead>
  <tbody>
  
    @foreach ($servicio as $item)          
    <tr>
        {{--  <td scope="row">{{$item->id}}</td>  --}}
        <td>{{$item->nombre}}</td>
        {{--  <td>{{$item->paquete}}</td>
        <td>{{$item->unidad == 1 ? 'persona' : 'servicio'}}</td>  --}}
         {{--  <td>{{$item->valor ==1 ? 'No aplica': $item->cantidad}}</td>  --}}
        <td style="text-align: right;">${{number_format($item->valor )}}</td>
    </tr>
    @endforeach
  
</table>

<br>
<table>
      <thead>
    <tr >

      <th style="font-size: 13px; text-align:left"scope="col">Observacion</th>
 

    </tr>
  </thead>
  <tr>
       
        <td>{{$data['obs']}}</td>

    </tr>
  </tbody>
</table>

<br>
     <table width="150">
                <colgroup span=2 align="end">
                <tr>
                    <td style="padding-top: 80px;" width="90%">
                        <table style="display: inline-flex;">
                            <tr>
                                <td width="50%">
                                    <div style="text-align: center;display:inline-block; width: 160px;">
                                        <ul>
                                            <div>
                                                <hr>
                                                <p>Recibido</p>
                                            </div>
                                        </ul>
                                    </div>
                                </td>
                                <td width="50%" style="text-align: center;">
                                    <div style="text-align: center;display:inline-block; width: 160px;">
                                        <ul>
                                            <div>
                                                <hr>
                                                <p>Elaborado</p>
                                            </div>
                                        </ul>
                                    </div>
                                </td>

                            </tr>
                        </table>
                    </td>
                    <td width="10%">
                        <table style="text-align: end;width: 200px;" class="table table-sm">
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <h7 style="font-weight: bold;"><span
                                                style="color:rgb(0, 18, 68);">SubTotal:</span></h7>
                                    </th>
                                    <td>
                                        <h7> ${{number_format($totalComision)}}</h7>
                                    </td>

                                </tr>
                                <tr>
                                    <th scope="row">
                                        <h7 style="font-weight: bold;"><span style="color:rgb(0, 18, 68);">Iva:</span>
                                        </h7>
                                    </th>
                                    <td>
                                        <h7>{{number_format($totalComision * $data['iva']/100)}}</h7>
                                    </td>

                                </tr>
                        
                                <tr>
                                    <th scope="row">
                                        <h7 style="font-weight: bold;"><span style="color:rgb(0, 18, 68);">Total:</span>
                                        </h7>
                                    </th>
                                    <td colspan="2">
                                        <h7>${{number_format($totalComision + $totalComision * $data['iva']/100 + $cuatroXmil)}}
                                        </h7>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
{{--  
    <table >
        <tr>
            <td width="33%">
                <div style="text-align: left;display:inline-block;">
                    <ul>
                        <div>
                            <li style="font-size: 12px;">  <img style=" margin-left: 50px;" src="http://hcapi.clinicalsoftware.org/img/codigoQR.jpeg"  height="80px" alt="logo"></li>
                          
                        </div>
                    </ul>
                </div>
            </td>
              <td width="20%" style="text-align: center;">
                <div style="text-align: center;display:inline-block;">
                    <ul>
                        <li>
                            <br>
                            <span><strong>Firma </strong></span>  <strong style=" margin-left: 61px;">Sello</strong> 
                             
                         
                        </li>
                        
                    </ul>
                </div>
            </td>
            <td width="33%">
                <div style="text-align: left;display:inline-block;">
                    <ul>
                        
                    </ul>
                </div>
            </td>
        </tr>
    </table>  --}}
    <input type="hidden" name="imprimir" value="Imprimir" onclick="window.print();">   
    <script>
        window.print();
    </script>
   
</main>
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</html>