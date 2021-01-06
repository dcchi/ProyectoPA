function marcarError(elemento, mensaje) {

    var texto = $(mensaje).text();
    var error = texto.substr(0,texto.length-1);
    
    $(elemento).css({"border": "2px solid red"});
    if ($(elemento).next().is("span")) {
    } else {
        var span = "<span class='error'>" + " ERROR: " + error + "</span>";
        ($(elemento)).after($(span));
    }
}


function conFoco(elemento) {

    document.getElementById(elemento).style.backgroundColor = "lavender";
    document.getElementById(elemento).style.fontStyle = "italic";

}

function sinFoco(elemento) {
    document.getElementById(elemento).style.backgroundColor = "";
    document.getElementById(elemento).style.fontStyle = "";
}

function comprobarElemento(elemento) {

    var des = $(elemento).val();
    var name = $(elemento).attr('name');
    if (!hasNumber(des)) {
        $(elemento).css({"border": ""});
        if ($(elemento).next().is("span")) {
            $(elemento).next().remove();
        }
    } else {
        var texto = $('label[for="' + name + '"]');

        if (texto.length <= 0) {
            var padreElemento = $(elemento).parent(), padreTagName = padreElemento.get(0).tagName.toLowerCase();

            if (padreTagName === "label") {
                texto = padreElemento;
            }
        }
        marcarError(elemento, texto);
    }
}

function hasNumber(myString) {
    return /\d/.test(myString);
}

function esLetra(x){
    return /[a-zA-Z]/.test(x);
}

function comprobarTelefono(elemento) {
    var valor = elemento.value;
    var digitos = valor.length;
    var ultimoDigito = valor.substr(valor.length - 1, valor.length);
    if (digitos >= 10 || esLetra(ultimoDigito)) {
        elemento.value = valor.substr(0, valor.length - 1);
    }
}

function validar() {
    var numSpanForm = $("form").has("span").length;

    if (numSpanForm > 0) {
        alert("Los datos introducidos no son correctos");
        return false;
    } else {
        return true;
    }
}