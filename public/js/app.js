var wrapper = document.getElementById("signature-pad"),
    clearButton = wrapper.querySelector("[data-action=clear]"),
    saveButton = wrapper.querySelector("[data-action=save]"),
    canvas = wrapper.querySelector("canvas"),
    signaturePad;

// Adjust canvas coordinate space taking into account pixel ratio,
// to make it look crisp on mobile devices.
// This also causes canvas to be cleared.
function resizeCanvas() {
    // When zoomed out to less than 100%, for some very strange reason,
    // some browsers report devicePixelRatio as less than 1
    // and only part of the canvas is cleared then.
    var ratio =  Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();

signaturePad = new SignaturePad(canvas);

clearButton.addEventListener("click", function (event) {
    signaturePad.clear();
});

saveButton.addEventListener("click", function (event) {
    if (signaturePad.isEmpty()) {
        alert("Por favor, firme antes de guardar");
    } else {
        // window.open(signaturePad.toDataURL());
		// obtenemos en base 64 el png de la firma digitalizada
		var firma = signaturePad.toDataURL();
		// insertamos en el código HTML del visor, en el formulario de Velneo, insertamos el churro en base 64 con la firma digitalizada
        // concretamente lo insertamos en el contenedor habilitado
        
        document.getElementById('contenedorV7').value = firma;
        console.log('contenedorV7', firma )
		// simulamos un click para que la conexión de evento Link clicked dispare el manejador que capturará y guardará la firma en base 64
		simulateClick('external')
    }
});


