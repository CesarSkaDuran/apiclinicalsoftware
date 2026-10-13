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
        .clearButton{
                background: #008aff;
                border-radius: 5px;
                color: white;
                padding: 10px 15px 10px 15px;
                border: 0px;
        }
        .saveButton{
              background: #02aa2c;
                border-radius: 5px;
                color: white;
                padding: 10px 15px 10px 15px;
                border: 0px;
        }
        * {
	padding: 0;
	margin: 0;
	box-sizing:border-box;
}

body {
	background: #fff;
	font-family: 'Open Sans', sans-serif;
}

.contenedor {
	width: 90%;
	max-width: 1000px;
	margin: 20px auto;
}

.contenedor article {
	line-height: 28px;
}

.contenedor article h1 {
	font-size: 30px;
	text-align: left;
	padding: 50px 0;
}

.contenedor article p {
	margin-bottom: 20px;
}

.contenedor article .btn-abrir-popup {
	padding: 0 20px;
	margin-bottom: 20px;
	height: 40px;
	line-height: 40px;
	border: none;
	color: #fff;
	background: #5E7DE3;
	border-radius: 3px;
	font-family: 'Montserrat', sans-serif;
	font-size: 16px;
	cursor: pointer;
	transition: .3s ease all;
	cursor: pointer;
}

.contenedor article .btn-abrir-popup:hover {
	background: rgba(94,125,227, .9);
}

/* ------------------------- */
/* POPUP */
/* ------------------------- */

.overlay {
	background: rgba(0,0,0,.3);
	position: fixed;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	align-items: center;
	justify-content: center;
	display: flex;
	visibility: hidden;
}

.overlay.active {
	visibility: visible;
}

.popup {
	background: #F8F8F8;
	box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.3);
	border-radius: 3px;
	font-family: 'Montserrat', sans-serif;
	padding: 20px;
	text-align: center;
	width: 600px;
	
	transition: .3s ease all;
	transform: scale(0.7);
	opacity: 0;
}

.popup .btn-cerrar-popup {
	font-size: 16px;
	line-height: 16px;
	display: block;
	text-align: right;
	transition: .3s ease all;
	color: #BBBBBB;
}

.popup .btn-cerrar-popup:hover {
	color: #000;
}

.popup h4 {
	font-size: 36px;
	font-weight: 600;
	margin-bottom: 10px;
	opacity: 0;
}

.popup h5 {
	font-size: 26px;
	font-weight: 300;
	margin-bottom: 40px;
	opacity: 0;
}

.popup form .contenedor-inputs {
	opacity: 0;
}

.popup form .contenedor-inputs input {
	width: 100%;
	margin-bottom: 20px;
	height: 52px;
	font-size: 18px;
	line-height: 52px;
	text-align: center;
	border: 1px solid #BBBBBB;
}

.popup form .btn-submit {
	padding: 0 20px;
	height: 40px;
	line-height: 40px;
	border: none;
	color: #fff;
	background: #5E7DE3;
	border-radius: 3px;
	font-family: 'Montserrat', sans-serif;
	font-size: 16px;
	cursor: pointer;
	transition: .3s ease all;
}

.popup form .btn-submit:hover {
	background: rgba(94,125,227, .9);
}

/* ------------------------- */
/* ANIMACIONES */
/* ------------------------- */
.popup.active {	transform: scale(1); opacity: 1; }
.popup.active h4 { animation: entradaTitulo .8s ease .5s forwards; }
.popup.active h5 { animation: entradaSubtitulo .8s ease .5s forwards; }
.popup.active .contenedor-inputs { animation: entradaInputs 1s linear 1s forwards; }

@keyframes entradaTitulo {
	from {
		opacity: 0;
		transform: translateY(-25px);
	}

	to {
		transform: translateY(0);
		opacity: 1;
	}
}

@keyframes entradaSubtitulo {
	from {
		opacity: 0;
		transform: translateY(25px);
	}

	to {
		transform: translateY(0);
		opacity: 1;
	}
}

@keyframes entradaInputs {
	from { opacity: 0; }
	to { opacity: 1; }
}
    </style>


<link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body onselectstart='return false' >
<header>
    <br>
    <table >
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
                        <li style="font-size: 13px;" ><strong>Fecha: </strong>  {{$data['date']}}</li>
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
        <h3>PROCEDIMIENTO N° {{$data['idTratamiento']}}</h3>
    </div>
    @endif

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
      <th scope="col">Id</th>
      <th scope="col">Nombre del medico o auxiliar</th>
      <th scope="col">Fecha</th>
      <th scope="col">Comentario</th>
      <th scope="col">Firma Paciente</th>
      <th scope="col">Firma Doctor</th>

    </tr>
  </thead>
  @foreach ($evolution as $item)     
  <tbody>

  
    <tr>
        <th scope="row"><p>{{$item->id}}</p></th>
        <td><p>{{$item->process}}</p></td>
        <td><p>{{$item->date}}</p></td>
        <td rowspan="2" valign="middle" align="left"><p>{!!$item->details!!}</p></td>
        <td><img src="{{$item->firma == null ? 'https://llevatilde.es/imagetexts/e/e4/ninguna.png' : $item->firma }}" style="height: 40px" /></td>
         <td><img src="{{$item->firma_medico == null ? $data['firma_doctor'] : $item->firma_medico }}" style="height: 40px" /></td>
        
    </tr>
    
    
</tbody>
@endforeach
</table>

        <div class="overlay" id="overlay">
			<div style="width: 90%" class="popup" id="popup">
				
				<h4>CAPTURA DE LA FIRMA</h4>
				{{--  <h5>Coloca la firma del paciente o del representante luego aceptar </h5>  --}}
                <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>  
                <div id='signature-pad' class='m-signature-pad'>
                    <div class='m-signature-pad--body'>
                                {{--  <div class='description'></div>  --}}
                        <canvas style="background: rgb(221, 221, 221); width: 100%;height: 50%;"></canvas>
                            </div>
                            <br>
                            <div class='m-signature-pad--footer'>
                            
                            <form style="margin-top: 20px;" action="{{route('preRegistro')}}"  method="post" role="form">
                                {{ csrf_field() }}
                            {{--  <input type="hidden" name="data_id" value="{{$data['id']}}" />   --}}
                            <input type="hidden" name="record_id" value="{{$data['record']}}" /> 
                            <input type="hidden" id="contenedorV7" name="contenedorV7" value="" />
                            <button class='button clear' data-action='clear'>Limpiar</button>
                            <button type="submit" class='button save' data-action='save'>Aceptar</button>
                            {{--  <button class='btn btn-primary' type="submit">Guardar</button>  --}}
                         </form>
                    </div>
                 </div>
			</div>
		</div>
{{--  
<div style="text-align: end;margin: 10px;">
        @if(isset($tratamiento))
    <h3>Total: ${{number_format($totalComision)}}</h3>
    @endif
</div>  --}}
        </table>


    <table >
        <tr>
            {{--  <td width="33%">
                <div style="text-align: left;display:inline-block;">
                    <ul>
                        <div>
                            <li style="font-size: 12px;">  <img style=" margin-left: 50px;" src="http://hcapi.clinicalsoftware.org/img/codigoQR.jpeg"  height="80px" alt="logo"></li>
                          
                        </div>
                    </ul>
                </div>
            </td>  --}}
              <td width="100%" style="text-align: center;">
                <div style="text-align: center;display:inline-block;">
                    <ul>
                        <li>
                         {{--  @if($data['firma'] == null)
                            <button style="padding-right: 70px; padding-left: 70px;padding-top: 10px;padding-bottom: 10px;" id="btn-abrir-popup" class="btn btn-outline-info">
                                firma aquí
                            </button>
                        @endif
                          @if($data['firma'] )
                            <img  height="100px" width="300" src="{{$data['firma']}}" />
                            @endif
                            @if($data['firma_doctor'])
                            <img src="{{$data['firma_doctor']}}"/>
                            @endif
                        </li>
                            <br>
                        @if($data['firma'] == null)
                        <li style="text-align: justify;">
                            <span><strong>Firma paciente o responsable </strong></span> 
                            <span>  <strong style=" margin-left: 40px;">Firma Doctor</strong> </span>
                             

                        </li>
                        @endif
                        @if($data['firma'] )
                        <li>
                            <span><strong>Firma paciente o responsable </strong></span> 
                            <span>  <strong style=" margin-left: 274px;">Firma Doctor</strong> </span>
                             
                         
                        </li>
                        @endif
                          --}}
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


<a id='external' href='#'></a>
 <img style=" margin-left: 50px;" src="http://hcapi.clinicalsoftware.org/img/codigoQR.jpeg"  height="80px" alt="logo">
    <p style="font-size: 10px; text-align: center; " > {!!$data['address']!!}   </p> <strong style="font-size:8px" > formula medica generada por : clinicalsoftware.org</strong>
</main>
</body>
<!-- JavaScript Bundle with Popper -->
<script>
function simulateClick(id) {
var evt = document.createEvent('MouseEvents');
evt.initMouseEvent('click', true, true, window, 1, 0, 0, 0, 0, false, false, false, false, 0, null);
var cb = document.getElementById(id);
cb.dispatchEvent(evt);
}

var btnAbrirPopup = document.getElementById('btn-abrir-popup'),
	overlay = document.getElementById('overlay'),
	popup = document.getElementById('popup'),
	btnCerrarPopup = document.getElementById('btn-cerrar-popup');

btnAbrirPopup.addEventListener('click', function(){
	overlay.classList.add('active');
	popup.classList.add('active');
});

btnCerrarPopup.addEventListener('click', function(e){
	e.preventDefault();
	overlay.classList.remove('active');
	popup.classList.remove('active');
});
</script>

<script src="{{asset('/js/signature_pad.js')}}"></script>
<script src="{{asset('/js/app.js')}}"></script>
<script src="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</html>