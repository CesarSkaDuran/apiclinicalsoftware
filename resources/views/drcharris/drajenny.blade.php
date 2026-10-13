  <!DOCTYPE html>

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

          .clearButton {
              background: #008aff;
              border-radius: 5px;
              color: white;
              padding: 10px 15px 10px 15px;
              border: 0px;
          }

          .saveButton {
              background: #02aa2c;
              border-radius: 5px;
              color: white;
              padding: 10px 15px 10px 15px;
              border: 0px;
          }

          * {
              padding: 0;
              margin: 0;
              box-sizing: border-box;
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
              background: rgba(94, 125, 227, .9);
          }

          /* ------------------------- */
          /* POPUP */
          /* ------------------------- */

          .overlay {
              background: rgba(0, 0, 0, .3);
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
              box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.3);
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
              background: rgba(94, 125, 227, .9);
          }

          /* ------------------------- */
          /* ANIMACIONES */
          /* ------------------------- */
          .popup.active {
              transform: scale(1);
              opacity: 1;
          }

          .popup.active h4 {
              animation: entradaTitulo .8s ease .5s forwards;
          }

          .popup.active h5 {
              animation: entradaSubtitulo .8s ease .5s forwards;
          }

          .popup.active .contenedor-inputs {
              animation: entradaInputs 1s linear 1s forwards;
          }

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
              from {
                  opacity: 0;
              }

              to {
                  opacity: 1;
              }
          }

      </style>


      <link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css')}}" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  </head>
  <div class="overlay" id="overlay">
      <div style="width: 90%" class="popup" id="popup">

          <h4>CAPTURA DE LA FIRMA</h4>
          {{--  <h5>Coloca la firma del paciente o del representante luego aceptar </h5>  --}}
          <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
          <div id='signature-pad' class='m-signature-pad'>
              <div class='m-signature-pad--body'>
                  {{--  <div class='description'></div>  --}}
                    <canvas style="background: rgb(221, 221, 221); width: 100%;height: 600px;"></canvas>
              </div>
              <br>
              <div class='m-signature-pad--footer'>

                <form style="margin-top: 20px;" action="{{route('firmaGuardarId')}}" method="post" role="form">
                      {{ csrf_field() }}
                      <input type="hidden" name="data_id" value="{{$data['record']}}" />
                      {{--  <input type="hidden" name="record_id" value="{{$data['record']}}" /> --}}
                      <input type="hidden" id="contenedorV7" name="contenedorV7" value="" />
                      <input type="hidden" name="nombre" value="drJenny" />
                      <button class='button clear' data-action='clear'>Limpiar</button>
                      <button type="submit" class='button save' data-action='save'>Aceptar</button>
                      {{--  <button class='btn btn-primary' type="submit">Guardar</button>  --}}
                  </form>
              </div>
          </div>
      </div>
  </div>
  <div style="margin-left: 20px; margin-right: 20px;margin-top: 50px;text-align: center;">
      <img style="height: 100px" src="{{$data['img_url']}}" alt="logo">
      <p>AVENIDA 1ª·#15-43 CETRO MEDICO DE ESPECIALISTA JERICO CONS 606 TEL.5831600</p>
      <h4 style="text-align: center">PROCEDIMIENTO ODONTOLOGIGO ODONTOLOGIA ESTETICA</h4>
      <p>FECHA: {{date('d M y')}}</p>

<textarea style="border: white; text-align: justify; margin:5px;" placeholder="....." id="my-textarea" class="form-control" name=""rows="4">
Yo,  {{strtoupper($data['name'])}}  identificado(a) con la cédula de ciudadanía número {{strtoupper($data['document'])}}  DE _____________ en representación de  identificado(a) con la T.I. DE , con {{strtoupper($data['age'])}}  años de edad quien cuento con la capacidad decisoria expresamente manifiesto:
   </textarea>
   <textarea style="border: white; text-align: justify; margin:5px; " placeholder="....." id="my-textarea" class="form-control" name=""rows="5">
1.	Que recibido de la DRA JENNY CONDE, explicación clara, precisa y comprensible de los procedimientos a los que seré sometido, los resultados y los beneficios de distinto orden por razón del siguiente tratamiento: ACLARAMIENTO DENTAL Y/O RESTAURACIONES CON RESINAS ESTETICAS.
   </textarea>
   <textarea style="border: white; text-align: justify; margin:5px; " placeholder="....." id="my-textarea" class="form-control" name=""rows="7">
2.	 La Doctora JENNY CONDE será la encargada de iniciar y terminar el tratamiento a menos que el paciente lo solicite. Si este es el caso se hará una remisión y se elaborará un resumen del tratamiento. PREVIO AL INICIO DEL TRATAMIENTO DE ODONTOLOGÍA ESTÉTICA EN MUCHAS OCASIONES EL PACIENTE PUEDE REQUERIR ENDODONCIA, OPERATORIA, PERIODONCIA U ORTODONCIA CORRECTIVA YA QUE CON RESINAS ES IMPOSIBLE CAMBIAR LA POSICIÓN DE LOS DIENTES. ESTAS REMISIONES LAS DEBE REALIZAR EL ESPECIALISTAS.
   </textarea>
   <textarea style="border: white; text-align: justify; margin:5px; " placeholder="....." id="my-textarea" class="form-control" name=""rows="10">
3.	Que igualmente he recibido información y acepto todos los riesgos inherentes a dicho tratamiento; así como las posibles lesiones o daños colaterales o secuelas que este puede ocasionar, que en general consisten en: SENSIBILIDAD DENTAL, FRACTURA DE RESTAURACIONES EN CASO DE NO USAR PLACA RPOTECTORA O PIGMENTACIONES DE LAS RESTAURACIONES POR NO SEGUIR INDICACIONES DADAS POR EL PROFESIONAL. Es importante tener en cuenta que el éxito del tratamiento va de la mano con el compromiso del paciente en el cumplimiento de las citas y de las indicaciones dadas al iniciar el tratamiento, también es claro que los resultados son diferentes en cada persona por su componente biológico. 
   </textarea>
   <textarea style="border: white; text-align: justify; margin:5px; " placeholder="....." id="my-textarea" class="form-control" name=""rows="10">
4.	Que se me ha suministrado información detallada sobre los cuidados que debo tener dentro de la fase de ejecución del procedimiento, el pos tratamiento , los cuales se resumen en los siguientes: CREMAS DENTALES ESPECIALES PARA SENSIBILIDAD DETAL, CUMPLIMIENTO DE CITAS, CUIDADO DE RESTAURACIONES Y PLACA PROTECTORA, BUENA HIGIENE ORAL Y SEGUIR LAS INDICACIONES DEL ESPECIALISTA. ES IMPORTANTE TENER EN CUENTA QUE EL TIPO DE TRATAMIENTO CON RESINAS ESTETICAS TIENE ALGUNAS LIMITACIONES DE MECANICA QUE NO PERMITEN REALIZAR ALGUNAS SOBRECARGAS DENTARIAS COMO ES MORDER OBJETOS O DESGARRAR ALIMENTOS DUROS CON DICHOS DIENTES Y QUE LA COLABORACIÓN DEL PACIENTE CON SU USO SON CLAVES PARA LA DURACIÓN Y LOS OBJETIVOS DE TRATAMIENTO.
   </textarea>
   <textarea style="border: white; text-align: justify; margin:5px; " placeholder="....." id="my-textarea" class="form-control" name=""rows="4">
5.	Se me enteró de las consecuencias posibles en caso de desatender las recomendaciones anteriores  que en general pueden describirse así: NO SE ALCANZAN LOS OBJETIVOS DE TRATAMIENTO.
   </textarea>
   <textarea style="border: white; text-align: justify; margin:5px; " placeholder="....." id="my-textarea" class="form-control" name=""rows="4">
6.	Que he sido debidamente notificado sobre las opciones y alternativas  de otros procedimientos, sus costos y resultados, de forma tal que expreso contar con toda la información requerida para tomar una decisión consciente y deliberada.
   </textarea>
   <textarea style="border: white; text-align: justify; margin:5px; " placeholder="....." id="my-textarea" class="form-control" name=""rows="5">
7.	Pueden presentarse algunas limitaciones en la obtención de objetivos de tratamiento que en general consisten en: NO REALIAR ACLARAMIETO DENTAL EN CASO DE PRESENTAR PATOLOGIAS EN EL COMPONENTE DENTARIO O EN CASO DE PULPITIS O MENORES DE 14 ÑOS DE EDAD.
</textarea>
<textarea style="border: white; text-align: justify; margin:5px; " placeholder="....." id="my-textarea" class="form-control" name=""rows="13">
8.	ES MUY IMPORTANTE TENER EN CUENTA QUE LOS RESULTADOS DEL TRATAMIENTO DEPENDEN  DE LA HABILIDAD DEL PROFESIONAL PARA LOGRAR LOS OBJETIVOS PROGRAMADOS INICIALMENTE. ESTOS OBJETIVOS LOS DETERMINA SEGÚN LA OCLUSIÓN Y LA FUNCIÓN MASTICATORIA, LOS PARÁMETROS DE ESTÉTICA DENTAL QUE RIGEN LA ODONTOLOGÍA COSMÉTICA Y LAS ESPECTATIVAS QUE EL PACIENTE TIENE CON RELACIÓN A SU SONRISA IDEAL. SE PUEDE REALIZAR UNA PREDICCIÓN DE LOS RESULTADOS ELABORANDO UN ENCERADO DE DIAGNÓSTICO QUE TIENE UN COSTO ADICIONAL.  UNA VEZ FINALIZA AL TRATAMIENTO ES IMPOSIBLE PREDECIR CON ABSOLUTA CERTEZA QUE EL PACIENTE SE SIENTA TOTALMENTE SATISFECHO CON LOS RESULTADOS OBTENIDOS, DE TODAS MANERAS EN ESTOS MOMENTOS TIENE LA OPRTUNIDAD DE SUGERIR CORRECCIONES QUE LO HAGAN SENTIR MEJOR AL SONREIR. SI DEFINITIVAMENTE DESEA RETIRARSE EL TRATAMIENTO NO SE HARÁ DEVOLUCIÓN DEL DINERO.
</textarea>
<textarea style="border: white; text-align: justify; margin:5px; " placeholder="....." id="my-textarea" class="form-control" name=""rows="4">
9.	ES IMPORTANTE TERNER EN CUENTA QUE CUANDO EL PACIENTE FALTA A LAS CITAS DURANTE EL TRATAMIENTO DE ACLARAMIENTO DENTAL NO ES POSIBLE CUMPLIR EL OBJETIVO.
</textarea>
<textarea style="border: white; text-align: justify; margin:5px; " placeholder="....." id="my-textarea" class="form-control" name=""rows="6">
10.	He contado con el tiempo necesario para madurar las decisiones contenidas en el presente documento; haciendo constar que me fue explicado el derecho que me asiste a arrepentirme o cambiar de opinión por cualquier razón y consecuentemente desistir del procedimiento o tratamiento previamente autorizado.
</textarea>
<textarea style="border: white; text-align: justify; margin:5px; " placeholder="....." id="my-textarea" class="form-control" name=""rows="3">
11.	Tiempo aproximado de tratamiento: para aclaramiento dental 3 a 4 semanas y una cita para las restauraciones de diseño de sonrisa con otra cita de cotrol.
</textarea>
<textarea style="border: white; text-align: justify; margin:5px; " placeholder="....." id="my-textarea" class="form-control" name=""rows="5">
12.	DENTRO DEL PRESUPUESTO DEL TRATAMIENTO NO ESTAN INCLUIDAS LAS REPARACIONES DE RESINAS FRACTURADAS O PIGMENTADAS, LOS RETENEDORES NI NUNGUN OTRO TRATAMIENTO QUE NO SE CONSIDERE ODONTOLOGIA ESTETICA.
</textarea>
<textarea style="border: white; text-align: justify; margin:5px; " placeholder="....." id="my-textarea" class="form-control" name=""rows="3">
13.	SE DEBEN REALIZAR CONTROLES CADA SEIS MESES PARA REALIZAR PULIDO DE RESINAS QUE TIENEN UN COSTO ADICIONAL.
</textarea>
<textarea style="border: white; text-align: justify; margin:5px; " placeholder="....." id="my-textarea" class="form-control" name=""rows="5">
14.	ES IMPORTANTE TENER CLARO QUE LA GARANTIA DE LAS RESTAURACIOES EN RESINAS ESTETICAS SON DURANTE EL TIEMPO QUE TRANSCURRE MIENTRAS SE HACE ENTREGA DE LA PLACA PROTECTORA, TENIEDO CLARO QUE EL PACIENTE DEBE CUMPLIR A LA CITA DE LA ENTREGA DE LA PLACA Y USARLA COMO SE LE EXPLICA.  TODA FRACTURA O PIGMENTACION O MODIFICACION QUE EL PACIENTE SOLICITE  DESPUES DE SER ENTREGADA LA PLACA TIENE UN COSTO ADICIONAL.
</textarea>
<textarea style="border: white; text-align: justify; margin:5px; " placeholder="....." id="my-textarea" class="form-control" name=""rows="5">
15.	Es importante tener en cuenta que los horarios del consultorio son de lunes a viernes de 8:00 am a 12:00m y de 2:00pm a 6pm. Los sábados serán de 9:00am a 12:00m. En estos horarios se atenderán las urgencias previa información a la auxiliar de odontología para ser programados.
</textarea>
<textarea style="border: white; text-align: justify; margin:5px; " placeholder="....." id="my-textarea" class="form-control" name=""rows="8">
16.	Se deja expresa constancia de la confidencialidad que tendrán los datos suministrados y consignados dentro del presente documento, el cual se incorporará a la historia clínica y formará parte integrante para todos los efectos legales.
Suscribimos el presente documento las personas que en él intervenimos:
   </textarea>


      <p>

          @if($data['firma'] == null)
          <button style="padding-right: 70px; padding-left: 70px;padding-top: 10px;padding-bottom: 10px;"
              id="btn-abrir-popup" class="btn btn-outline-info">
              firma aquí
          </button>
          @endif
      </p>
      <p>
          @if($data['firma'] )
          <img height="100px" width="300" src="{{$data['firma']}}" />
          @endif
      </p>
      <p>
          FIRMA DE PACIENTE O REPRESENTANTE:
      </p>
      @if($data['firma_doctor'])
      <img src="{{$data['firma_doctor']}}" />
      @endif
      <p> DRA JENNY CONDE 
      </p>
  </div>
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

      btnAbrirPopup.addEventListener('click', function () {
          overlay.classList.add('active');
          popup.classList.add('active');
      });

      btnCerrarPopup.addEventListener('click', function (e) {
          e.preventDefault();
          overlay.classList.remove('active');
          popup.classList.remove('active');
      });

  </script>

  <script src="{{asset('/js/signature_pad.js')}}"></script>
  <script src="{{asset('/js/app.js')}}"></script>
  <script src="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js')}}"
      integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
  </script>

  </html>
