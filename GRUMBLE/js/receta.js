var sendOK = false;

function conFoco(elemento) {
    var idElemento = "#" + elemento.id;
    
    if ($(idElemento).next().is("span")) {
        $(idElemento).next().remove();
        $(idElemento).css({"border": ""});
    }
    document.getElementById(elemento.id).style.backgroundColor = "lavender";
    document.getElementById(elemento.id).style.fontStyle = "italic";
}

function sinFoco(elemento) {
    document.getElementById(elemento.id).style.backgroundColor = "";
    document.getElementById(elemento.id).style.fontStyle = "";
    comprobarVacio(elemento);
}

function comprobarVacio(elemento) {

    var valorElemento = elemento.value;
    var elementoSinEspacios = valorElemento.replace(/\s/g, '');
    var idElemento = "#" + elemento.id;

    if (elementoSinEspacios === "") {
        var textoError = document.createTextNode("Debe introducir este campo");
        marcarError(idElemento, textoError);
        sendOK = false;
    } else {
        sendOK = true;
    } 
}

function marcarError(elemento, mensaje) {

    var texto = $(mensaje).text();

    $(elemento).css({"border": "2px solid red"});
    if ($(elemento).next().is("span")) {
    } else {
        var span = "<span class='error'>" + " ERROR: " + texto + "</span>";
        ($(elemento)).after($(span));
    }
}

function validar() {
    var formulario = $('#recetaForm :input'); //APUNTAR PERDIDA FOCO
    var arrayInputs = Array.from(formulario);

    for (var i = 0; i < 1; i++) {
        var nameInput = arrayInputs[i].name;
        var nameJQuery = "[name='" + nameInput + "']";
        $(nameJQuery).blur(sinFoco(arrayInputs[i]));
    }

    if (!sendOK) {
        alert("ERROR: Hay datos incorrectos");
        return false;
    } else {
        return true;
    }
}

function volver() {
    document.location.href = 'carta.php';
}