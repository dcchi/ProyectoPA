function marcarError(elemento, mensaje) {

    var texto = $(mensaje).text();

    $(elemento).css({"border": "2px solid red"});
    if ($(elemento).next().is("span")) {
    } else {
        var span = "<span class='error'>" + " ERROR: " + texto + "</span>";
        ($(elemento)).after($(span));
    }
}

function marcarSerguridad(elemento, mensaje) {
    var texto = $(mensaje).text();

    if ($(elemento).next().is("span")) {
        $(elemento).next().remove();
    }
    var span = "<span class='seguridad'>" + "La seguridad de su contraseña es " + texto + "</span>";
    ($(elemento)).after($(span));
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

function esLetra(x) {
    return /[a-zA-Z]/.test(x);
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

function comprobarEmail(idInput) {

    var email = $(idInput).val();
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!regex.test(email)) {
        var texto = document.createTextNode("Formato del email incorrecto");
        marcarError(idInput, texto);
    } else {
        $(idInput).css({"border": ""});
        if ($(idInput).next().is("span")) {
            $(idInput).next().remove();
        }
    }
}

function seguridadPassword(password) {

    var valorPass = $("#" + password).val();
    var idPass = "#" + password;
    var seguridad = 1;
    var arraySeguridad = [/.{5,}/, /[a-z]+/, /[0-9]+/, /[A-Z]+/];

    jQuery.map(arraySeguridad, function (regexp) {
        if (valorPass.match(regexp)) {
            seguridad++;
        }
    });

    switch (seguridad) {
        case 1:
            $(idPass).css("background-color", "red");
            var texto = document.createTextNode("muy baja");
            marcarSerguridad(idPass, texto);
            break;
        case 2:
            $(idPass).css("background-color", "salmon");
            var texto = document.createTextNode("baja");
            marcarSerguridad(idPass, texto);
            break;
        case 3:
            $(idPass).css("background-color", "yellow");
            var texto = document.createTextNode("normal");
            marcarSerguridad(idPass, texto);
            break;
        case 4:
            $(idPass).css("background-color", "lime");
            var texto = document.createTextNode("alta");
            marcarSerguridad(idPass, texto);
            break;
        case 5:
            $(idPass).css("background-color", "green");
            var texto = document.createTextNode("muy alta");
            marcarSerguridad(idPass, texto);
            break;
    }
}

function comprobarPassword(idConfPass) {

    var confPass = $(idConfPass).val();
    var nuevaPass = $("#nuevaPass").val();

    if (confPass !== nuevaPass) {
        var texto = document.createTextNode("Las contraseñas no coinciden");
        marcarError(idConfPass, texto);
    } else {
        $(idConfPass).css({"border": ""});
        if ($(idConfPass).next().is("span")) {
            $(idConfPass).next().remove();
        }
    }
}

function esFechaFutura(fechaCreacion) {
    var fecha = $(fechaCreacion).val();
    var fechaHoy = formatoFecha();

    if (fecha > fechaHoy) {
        var texto = document.createTextNode("La fecha no puede ser más que hoy");
        marcarError(fechaCreacion, texto);
    } else {
        $(fechaCreacion).css({"border": ""});
        if ($(fechaCreacion).next().is("span")) {
            $(fechaCreacion).next().remove();
        }
    }
}

function formatoFecha() {

    var f = new Date();

    var m = "" + (f.getMonth() + 1);
    var d = "" + f.getDate();
    var a = f.getFullYear();

    if (m.length < 2) {
        m = "0" + m;
    }
    if (d.length < 2) {
        d = "0" + d;
    }
    var fecha = [a, m, d].join('-');
    return  fecha;
}