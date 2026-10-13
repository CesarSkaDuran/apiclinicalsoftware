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
@media print
{    
    .no-print, .no-print *
    {
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
                      <input type="hidden" name="nombre" value="angelica" />
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
      <h5 style="text-align: center">
          CONSENTIMIENTO INFORMADO PARA LA REALIZACIÓN DE LA CIRUGÍA PERIAPICAL Y APICECTOMÍA</h5>
      <h5 style="text-align: center">
          MARÍA ANGÉLICA FARELO SUAREZ
          ODONTOLOGO (FUSM) ENDODONCISTA (USTA)</h5>
      <p>CIUDAD: CUCUTA</p>
<textarea style="border: white; text-align: justify; margin:5px;" placeholder="....." id="my-textarea" class="form-control" name=""rows="27">
Yo,  {{strtoupper($data['name'])}} identificado(a)  {{strtoupper($data['document'])}} en pleno uso de mis facultades, libre y voluntariamente, DECLARO que he sido debidamente informado por MARIA ANGELICA FARELO SUAREZ, ENDODONCISTA y en consecuencia, LA AUTORIZO para que me sea realizado el procedimiento diagnóstico/terapéutico denominado CIRUGÍA PERIAPICAL o  cualquier otro procedimiento que estime necesario para completar el tratamiento previsto. Me doy por enterado/a de los siguientes puntos relativos a dicho procedimiento:
La cirugía oral se hace necesaria para el tratamiento de muy diversas problemas y patologías de a cavidad oral. Entre dichas patologías se encuentran las lesiones periapicales y de los ápices radiculares de los diversos dientes, para cuyo correcto tratamiento se hace necesaria la cirugía periapical. 
Como consecuencia de una caries, patología dental o un traumatismo dental e puede producir una necrosis de la pulpa, seguida de una infección crónica en la región apical periapical de su raíz, que con el tiempo desarrolla un granuloma periapical y en ocasiones quistes dentarios. 
El paso inicial para tratamiento de estas lesiones suele ser la endodoncia del diente afectado y, en caso de fracaso de la misma, no resolución completa de la lesión o gran tamaño de la misma, se realiza la apicectomía de todas las raíces afectadas. La apicectomía es la extirpación del extremo final de una raíz dental, con limpieza de la cavidad residual y obturación y sellado, en caso necesario, de los conductos radiculares cuando ésta fuese incompleta. 
He sido informado (a) y entiendo que la realización de esta intervención NO GARANTIZA la permanencia de la pieza dental en cuestión en mi boca, siendo en ocasiones necesaria la extracción de la misma. En casos indicados es necesaria la reconstrucción del lecho quirúrgico mediante injertos de hueso, fracción plasmática rica en factores de crecimiento del propio paciente u otros materiales sintéticos, con el fin de asegurar el éxito y viabilidad de los dientes tratados. La intervención puede realizarse con anestesia general o local con el riesgo inherente asociado a la misma, que serán informados por su anestesista, y los fármacos utilizados pueden producir determinadas alteraciones del nivel de conciencia por lo que no podré realizar determinadas actividades inmediatamente, tales como conducir un vehículo. 
</textarea>
<textarea style="border: white; text-align: justify; margin:5px;" placeholder="....." id="my-textarea" class="form-control" name=""rows="33">

Todos estos procedimientos tienen el fin de conseguir un indudable beneficio,sin embargo no están exentos de complicaciones, algunas de ellas inevitables en casos excepcionales,siendo las estadísticamente más frecuentes:
- Alergia al anestésico, o medicaciones utilizados antes, durante o después de la cirugía.
- Hematoma, hemorragia e inflamación postoperatoria de la zona intervenida.
- Infección postoperatoria del lecho quirúrgico y/o materiales utilizados.
- Apertura de los puntos de sutura.
- Daño a los dientes vecinos.
- Falta de sensibilidad parcial o total, temporal o permanente del nervio dentario inferior (sensibilidad del labio inferior).
- Falta de sensibilidad parcial o total del nervio lingual, temporal o definitiva (de la lengua y del gusto).
- Falta de sensibilidad parcial o total del nervio infraorbitario (de la mejilla), temporal o definitiva.
- Infección de los tejidos o del hueso.
- Sinusitis.
- Comunicación entre la boca y la nariz o los senos maxilares.
- Fracturas óseas.
- Rotura de instrumental.
          
Recibida la anterior información, considero que he comprendido la naturaleza y propósitos del procedimiento.
Además en entrevista personal con la Endodoncista, he sido informado/a, en términos que he comprendido, del alcance de dicho tratamiento. En la entrevista he tenido la oportunidad de proponer y resolver mis posibles dudas, y de obtener cuanta información complementaria he creído necesaria. Por ello, me considero en condiciones de sopesar debidamente tanto sus posibles riesgos como la utilidad y beneficios que de él puedo obtener.
          
DOY MI CONSENTIMIENTO para que se me practique la cirugía periapical en el DIENTE  Este consentimiento puede ser revocado por mí sin necesidad de justificación alguna, en cualquier momento antes de realizar el procedimiento. Fecha: {{date('d/m/20y')}}          
</textarea>
      <p>

          @if($data['firma'] == null)
          <button style="padding-right: 70px; padding-left: 70px;padding-top: 10px;padding-bottom: 10px;"
              id="btn-abrir-popup" class="btn btn-outline-info no-print">
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
    <div class=" no-print" data-toggle="buttons">
    <label class="btn btn-secondary active">
      <button type="button" class="btn btn-secondary btn-lg" >1</button>
    </label>
    
    <label class="btn btn-secondary">
        <a href="{{route('generatedraAngelica2', [$data['id']])}}">
            <button type="button" class="btn btn-secondary btn-lg" >2</button>
        </a>
    </label>

    <label class="btn btn-secondary">
        <a href="{{route('generatedraAngelica3', [$data['id']])}}">
       <button type="button" class="btn btn-secondary btn-lg" >3</button>
        </a>
    </label>
    </div>
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
