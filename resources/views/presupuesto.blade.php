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
@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
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
                <img src="{{$data['img_url']}}"  height="100px" alt="logo">
            </td>
            <td style="text-align: center; " width="33%">
                <ul>
                    <li><strong style="text-transform: uppercase; font-size: 15px;">{{$data['doctor_name']}}</strong></li>
                  
                    <li style="font-size: 13px"><strong>{{$data['specialization']}}</strong></li>
                     <li style="font-size: 13px;position: relative;"><strong>{!!$data['address']!!}</strong></li>
                     {{--  <li style="font-size: 10px;">{!!$data['details']!!}</li>  --}}
                </ul>
            </td>
            <td style="text-align: center;" width="33%">
                <div style="text-align: left;display:inline-block;">
                     <ul>
                        <strong><li style="font-size: 13px;" >{{$data['message']}}</li></strong>
                    </ul>
                    
                    <ul><li><button class="btn btn-info text-white no-print"><a href="{{route('generatePresupuestoPost', $data['record'] )}}">Factura post</a></button></li>
                        <br>
                        <li style="font-size: 13px;" ><strong>Historia Clínica: </strong> {{$data['record']}}</li>
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
        @if(isset($tratamiento))
    <div style="text-align: center">
        <h5>PRESUPUESTO N° {{$data['idTratamiento']}}</h5>
    </div>
    @endif
 <div style="margin:30px;border: 1px solid #888; border-radius: 5px 5px 0px 0px;">
     
    <table>
        <tr>
            <td width="33%">
                <div style="text-align: left;display:inline-block;">
                    <ul>
                        
                        <li style="font-size: 13px;" ><strong>Documento: </strong> {{$data['document']}}</li>
                        <li style="font-size: 13px;" ><strong>Nombre: </strong> {{$data['name']}}</li>
                        <li style="font-size: 13px;" ><strong>Género: </strong> {{$data['gender']}}</li>
                        <li style="font-size: 13px;" ><strong>Fecha de Nacimiento: </strong> {{$data['fechaNacimiento']}}</li>
                    </ul>
                </div>
            </td>
            <td width="33%" style="text-align: center;">
                <div style="text-align: left;display:inline-block;">
                    <ul>
                        <li style="font-size: 13px;" ><strong>Edad: </strong> {{$data['age'] }}</li>
                        <li style="font-size: 13px;" ><strong>Direccion: </strong> {{$data['city']}}</li>
                        <li style="font-size: 13px;" ><strong>Correo: </strong> {{$data['email']}}</li>
                    </ul>
                </div>
            </td>
            <td width="33%" style="text-align: center;">
                <div style="text-align: left;display:inline-block;">
                    <ul>
                        <li style="font-size: 13px;" ><strong>IPS: </strong> 
                            {{ $data['ips'] == 1 ? "Aliansalud":"" }}
                            {{ $data['ips'] == 2 ? "Comparta EPS":"" }}
                            {{ $data['ips'] == 3 ? "Compensar":"" }}
                            {{ $data['ips'] == 4 ? "Confenalco Valle":"" }}
                            {{ $data['ips'] == 5 ? "Coomeva":"" }}
                            {{ $data['ips'] == 6 ? "Coosalud":"" }}
                            {{ $data['ips'] == 7 ? "Cruz blanca":"" }}
                            {{ $data['ips'] == 8 ? "EPS S.O.S":"" }}
                            {{ $data['ips'] == 9 ? "Famisanar":"" }}
                            {{ $data['ips'] == 10 ? "Medimás":"" }}
                            {{ $data['ips'] == 11 ? "Nueva EPS":"" }}
                            {{ $data['ips'] == 12 ? "Salud Total":"" }}
                            {{ $data['ips'] == 13 ? "Sanitas":"" }}
                            {{ $data['ips'] == 14 ? "Sura":"" }}
                            {{ $data['ips'] == 0 ? "No tiene":"" }}
                        </li>
                        <li style="font-size: 13px;" ><strong>Teléfono: </strong> {{$data['phone']}}</li>
                    </ul>
                </div>
            </td>
        </tr>
    </table>

<table class="table table-bordered" style="margin-bottom: 0;">
  <thead>
    <tr>
      {{--  <th scope="col">Id</th>  --}}
      <th scope="col">Procedimiento</th>
      <th scope="col">Pieza</th>
      <th scope="col">comentario</th>
      <th scope="col">valor</th>

    </tr>
  </thead>
  <tbody>
    @if(isset($tratamiento))
    @foreach ($tratamiento as $item)          
    <tr>
        {{--  <th scope="row">{{$item->id}}</th>  --}}
        <td>{{$item->procedimiento}}</td>
        <td>{{$item->pieza}}</td>
        <td>{{$item->obs == null? '' : $item->obs}}</td>
        <td>${{number_format($item->valor)}}</td>
    </tr>
    @endforeach
    @endif
  </tbody>
</table>

<div style="text-align: end;margin: 10px;">
        @if(isset($tratamiento))
    <h5>Total: ${{number_format($totalComision)}}</h5>
    @endif
</div>
        </table>
    </div>

    <table >
        <tr>
            <td width="33%">
                <div style="text-align: left;display:inline-block;">
                    <ul>
                        <div>
                            {{--  <li style="font-size: 12px;">  <img style=" margin-left: 50px;" src="http://hcapi.clinicalsoftware.org/img/codigoQR.jpeg"  height="80px" alt="logo"></li>  --}}
                          
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
                             
                            {{--  <span style="margin-left: 10em;"><strong>Sello </strong></span>  --}}
                        </li>
                        
                    </ul>
                </div>
            </td>
            <td width="33%">
                <div style="text-align: left;display:inline-block;">
                    <ul>
                        {{--  <li style="font-size:8px">formula medica generada por : clinicalsoftware.org</li>  --}}
                    </ul>
                </div>
            </td>
        </tr>
    </table>
    <p style="font-size: 10px; margin:20px; text-align: end; " >  <strong style="font-size:8px" > formula medica generada por : clinicalsoftware.org</strong> </p> 
</main>
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</html>