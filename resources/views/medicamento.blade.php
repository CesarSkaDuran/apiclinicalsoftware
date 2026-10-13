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
</head>
<body>
<header>
    <table>
        <tr>
            <td style="text-align: center;" width="30%">
                <img src="{{$data['img_url']}}"  height="100px" alt="logo">
            </td>
            <td style="text-align: center; " width="33%">
                <ul>
                    <li><strong style="text-transform: uppercase; font-size: 17px;">{{$data['doctor_name']}}</strong></li>
                  
                    <li style="font-size: 15px"><strong>{{$data['specialization']}}</strong></li>
                     <li style="font-size: 11px;position: relative; top: 9px;">{!!$data['university']!!}</li>
                     {{--  <li style="font-size: 10px;">{!!$data['details']!!}</li>  --}}
                </ul>
            </td>
            <td style="text-align: center;" width="33%">
                <div style="text-align: left;display:inline-block;">
                     <ul>
                        <strong><li style="font-size: 13px;" >{{$data['message']}}</li></strong>
                    </ul>
                    
                    <ul>
                        <li style="font-size: 13px;" ><strong>Historia Clínica: </strong> {{$data['record']}}</li>
                        <li style="font-size: 13px;" ><strong>Orden No. </strong> {{$data['order']}}</li>
                        <li style="font-size: 13px;" ><strong>Fecha: </strong> {{$data['date']}}</li>
                    </ul>
                </div>
            </td>
        </tr>
    </table>
</header>
 
<main>
 <div class="container" style="padding:10px;border: 1px solid #888; border-radius: 10px;">
    <table>
        <tr>
            <td width="33%">
                <div style="text-align: left;display:inline-block;">
                    <ul>
                        
                        <li style="font-size: 13px;" ><strong>Documento: </strong> {{$data['document']}}</li>
                        <li style="font-size: 13px;" ><strong>Nombre: </strong> {{$data['name']}}</li>
                        <li style="font-size: 13px;" ><strong>Género: </strong> {{$data['gender']}}</li>
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
    <hr>
    
     <table>

        
         <tr>
            <td width="33%" style="vertical-align: top;">
                <div style="text-align: left;display:inline-block;">
                    <ul>
                        
                        @foreach($data['medicines'] as $dataMed)
                              <li style="font-size: 13px;" ><strong>Medicamento: </strong> {{$dataMed['medicine']['cum']}} | {{$dataMed['medicine']['name']}} | {{$dataMed['administration']}} | {{$dataMed['measure' ]}}  | {{$dataMed['dose' ]}}  | {{$dataMed['frequency' ]}}  | Cantidad {{$dataMed['quantity' ]}}  | duración {{$dataMed['duration' ]}}  | </li>
                              <li style="font-size: 11px"> </li> 
                             @endforeach 
                      
                        </ul>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <table >
        <tr>
            <td width="33%">
                <div style="text-align: left;display:inline-block;">
                    <ul>
                        <div class="container">
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
    <p style="font-size: 10px; text-align: center; " > {!!$data['address']!!}   </p> <strong style="font-size:8px" > formula medica generada por : clinicalsoftware.org</strong>
</main>
</body>
</html>