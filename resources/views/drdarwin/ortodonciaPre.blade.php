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
          @media print{
            .oculto-impresion, .oculto-impresion *{
                display: none !important;
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
                      <input type="hidden" name="nombre" value="ortodoncia" />
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
      <p>Avenida Gran Colombia # 3 E – 72.    TEL:  3118801623.     </p>
      <h4 style="text-align: center">CONSENTIMIENTO INFORMADO PARA ORTODONCIA PREQUIRÚRGICA</h4>
      <p>FECHA: {{date('d M y')}}</p>
<textarea style="border: white; text-align: justify; margin:5px;" placeholder="....." id="my-textarea" class="form-control" name=""rows="6">
Por medio de la presente constancia, en pleno y normal uso de mis facultades mentales. Yo, {{strtoupper($data['name'])}}  , identificado (a) con documento de identidad número de CC  {{strtoupper($data['document'])}}  expedido en la ciudad de , domiciliado (a) en                   otorgo en forma libre mi consentimiento al Doctor (a)                          , para que en ejercicio legal de su profesión se me practique el procedimiento de ortodoncia prequirúrgica.
</textarea>
<textarea style="border: white; text-align: justify; margin:5px;" placeholder="....." id="my-textarea" class=" form-control" name=""rows="40">
   PLAN DE TRATAMIENTO :

    1.	ORTODONCIA PREQUIRÚRGICA
    Objetivos de la Ortodoncia Prequirúrgica:
    -	Realizar alineación y nivelación de arcos
    -	Lograr descompensación dental para lograr inclinación ideal respecto a sus bases óseas.
    -	Nivelar curva de spee
    -	Lograr torque ideal para acople oclusal
    -	Centrar líneas medias dentales con la línea media facial

    2.	FASE QUIRÚRGICA
    -    Según el criterio del cirujano maxilofacial se realizará la cirugía ortognática para lograr una retrusión mandibular y después de la fase de ortodoncia prequirúgica y exámenes complementarios se determinará si la cirugía será uni o bimaxilar.

    3.	FASE DE ORTODONCIA POSTQUIRÚRGICA
    En ésta fase se realizará el ajuste y detallado final de la olcusión con elásticos intermaxilares para mejorar el acople e interdigitación dental.
    Yo, José Gabriel Cárdenas Cortés identificado con cc 1092389106 soy consciente que la solución ideal para solucionar mi problema oclusal es con cirugía ortognática y autorizo al Dr Darwin Antonio Medina Jaimes con cc 88264736 especialista en ortodoncia para manejar mi caso clínico y realizar la fase de ortodoncia prequirúrgica.
    Se me han explicado las consecuencias de realizarme mi ortodoncia prequirúrgica y luego desistir de la cirugía ya que esto afectaría aún más mi oclusión y mi perfil facial se vería muy comprometido estéticamente.

    Mediante éste consentimiento declaro que me realizaré la cirugía ortognática para corregir de manera definitiva mis problemas articulares, dentales y faciales.

    Se me explicó de forma muy clara que el diente 11 presenta una gran reabsorción radicular y el movimiento ortodóntico puede empeorar el pronóstico de éste diente e inclusive perderlo, soy consciente que al finalizar mi tratamiento de ortodoncia y cirugía lo ideal es rehabilitar el diente 11 con un implante dental.

    Para satisfacción de los derechos del paciente, como instrumento favorecedor del correcto uso de los procedimientos terapeúticos y diagnósticos y en cumplimiento de la normatividad colombiana vigente.

    Yo {{strtoupper($data['name'])}} , mayor de edad, actuando en nombre propio, identificado como aparece al pie de mi firma, en pleno uso de mis facultades mentales, libre consiente y voluntariamente DECLARO que el Dr              me ha explicado en términos asequibles, todo el proceso de ortodoncia prrequirúrgica, cirugía ortognática y ortodoncia postquirúrgica, así como sus ventajas, desventajas y riesgos y  las consecuencias de iniciar el proceso de ortododoncia y no culminarlo de la manera planteada.

</textarea>

      <p>
  
        @if($data['firma'] == null)
                <button style="padding-right: 70px; padding-left: 70px;padding-top: 10px;padding-bottom: 10px;" id="btn-abrir-popup" class="oculto-impresion btn btn-outline-info">
                        firma aquí
                </button>
        @endif
      </p>
      <p>  
              @if($data['firma'] )
                   <img  height="100px" width="300" src="{{$data['firma']}}" />
              @endif
      </p>
      <p>
          FIRMA DE PACIENTE O REPRESENTANTE:
      </p>
      @if($data['firma_doctor'])
      <img src="{{$data['firma_doctor']}}" />
      @endif
      <p><strong> Dr. Darwin Medina </strong>
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
