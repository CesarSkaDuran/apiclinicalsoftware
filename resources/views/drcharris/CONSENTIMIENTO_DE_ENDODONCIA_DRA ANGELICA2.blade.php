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
                      <input type="hidden" name="nombre" value="angelica2" />
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
          MARÍA ANGÉLICA FARELO SUAREZ
          ODONTOLOGO (FUSM) ENDODONCISTA (USTA)</h5>
      <h5 style="text-align: center"> CONSENTIMIENTO INFORMADO PARA ACLARAMIENTO INTERNO DE DIENTES </h5>
<textarea style="border: white; text-align: justify; margin:5px;" placeholder="....." id="my-textarea" class="form-control" name=""rows="30">

Nombre del Paciente: {{strtoupper($data['name'])}}  Fecha:{{date('d/m/20y')}}
Diente:
Entiendo que las manchas marrones o amarillas se blanquean mejor que las manchas grises o azules.
Algunas manchas regresan después de que el tratamiento termina. En estos casos es posible que sea necesario otro tratamiento.
Entiendo que los dientes con muchos empastes pueden no blanquearse y normalmente el resultado es mejor cuando son tratados con otras alternativas.
Entiendo que hay posibilidad de fractura del diente debido a la deshidratación sufrida por la endodoncia y el blanqueamiento como tal.
Entiendo que los tratamientos para blanquear los dientes sólo aclaran la estructura natural del diente y no pueden aclarar coronas, carillas, compuestos u otros materiales de restauración.
Entiendo que los tratamientos profesionales para blanquear dientes en el consultorio pueden requerir más de una visita al consultorio. La mayoría de los tratamientos para blanquear resultarán en dientes más claros por uno o dos tonos de acuerdo a la tabla de tonos dentales.
Si elijo participar en un programa para blanquear los dientes en casa, entiendo que hay instrucciones específicas que debo seguir. 
Entre otros, los riesgos del blanqueo de dientes son los siguientes:
Entiendo que el tratamiento para blanquear los dientes es impredecible y que no hay garantías de que funcionará.
Entiendo que las encías y/o el tejido suave en mi boca puede estar expuesto a varios agentes usados en los procedimientos para blanquear los dientes, lo que puede causar una reacción alérgica o inflamación. Esto puede deberse a una exposición accidental de una pequeña parte de esos tejidos al gel blanqueador o a la luz ultra violeta. Si esto pasa, llamaré al Dr.
Entiendo que es imposible fijar un plazo de tiempo específico durante el cual la apariencia de los dientes blanqueados mantendrá el tono claro. Estos periodos de tiempo pueden variar dependiendo de las condiciones que existan a partir de mis hábitos o circunstancias (por ejemplo, si tomo café a diario, fumo, o genética) que pueden ser internas, externas, o ambas.
Entiendo que la exposición prolongada a los productos blanqueadores pueden desgastar el esmalte del diente.
</textarea>

<textarea style="border: white; text-align: justify; margin:5px;" placeholder="....." id="my-textarea" class="form-control" name=""rows="25">
Adicionalmente, cualquier sensibilidad existente, recesión, exposición a la dentina u otras condiciones dentales que puedan causar sensibilidad o permitir la penetración del producto blanqueador en el diente, pueden requerir tratamiento adicional.
Entiendo que la aplicación profesional de los productos blanqueadores mis labios pueden quedar secos o cortados. 
Esto puede ser tratado con la aplicación de un humectante para labios, vaselina, o crema con vitamina E.
Entre otras, las consecuencias si no se administra el tratamiento son las siguientes:
Entiendo que si no participo en los procedimientos para blanquear los dientes, el color de mis dientes puede continuar igual o decolorarse aún más.
Entre otras, las alternativas al blanqueo de dientes son las siguientes:
Entiendo que dependiendo de la razón por la cual requiero que mis dientes sean blanqueados, hay posibles alternativas que no están limitadas a: sistemas adhesivos, coronas y carillas. He preguntado a mi odontólogo sobre estas alternativas y sus respectivos costos. Mis preguntas sobre los riesgos, beneficios y costos, han sido respondidas a mi satisfacción.
Alternativas discutidas:

Nadie me ha garantizado o asegurado que el propuesto tratamiento curará o mejorará la condición (o condiciones) mencionada anteriormente.
Se me ha dado la oportunidad de formular preguntas y doy mi consentimiento para el tratamiento propuesto tal y como se describe anteriormente.
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
    <label class="btn btn-secondary ">
         <a href="{{route('generatedraAngelica', [$data['id']])}}">
      <button type="button" class="btn btn-secondary btn-lg" >1</button>
              </a>
    </label>
    
    <label class="btn btn-secondary active">
            <button type="button" class="btn btn-secondary btn-lg" >2</button>
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
