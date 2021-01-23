function redirigirProfesional() {
    document.location.href = 'configProfesional.php';
}

function redirigirParticular() {
    document.location.href = 'configParticular.php';
}

function redirigirCarta() {
    document.location.href = 'carta.php';
}

function guardarPost() {
    var fechaPublicacion = Date.now();
    var mensaje = $('#txtPost').val();
    var idUsuario = $('#idUsuario').val();

    $.ajax({
        url: "../dao/savePost.php",
        type: "POST",
        data: {
            idUsuario: idUsuario,
            mensaje: mensaje,
            fechaPublicacion: fechaPublicacion
        },
        cache: false,
        success: function (dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#txtPost').val('');
                $("#success").show();
                $("#success").html("¡Se ha publicado su post!");
            } else {
                alert("ERROR: Se ha producido un error");
            }
        }
    });
}

function comprobarTextArea(txt) {
    var txtActual = txt.value;
    var tamanyo = txtActual.length;

    if (tamanyo > 150) {
        txt.value = txtActual.substr(0, tamanyo - 1);
    }
}