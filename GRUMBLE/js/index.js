function redirigirProfesional() {
    document.location.href = 'configProfesional.php';
}

function redirigirParticular() {
    document.location.href = 'configParticular.php';
}

function redirigirGaleria() {
    document.location.href = 'galeria.php';
}

function redirigirResenya() {
    document.location.href = 'nuevaResenya.php';
}

function redirigirCarta() {
    document.location.href = 'carta.php';
}

function guardarPost() {
    var fechaPublicacion = Date.now();
    var mensaje = $('#txtPost').val();
    var idUsuario = $('#idUsuario').val();
    var foto = $('#fotoPost').val();
    var fotoOG = $('#fotoPost').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', fotoOG);
    var fechaSTR = fechaPublicacion.toString();
    form_data.append('fecha', fechaSTR);
    if (foto !== "") {
        foto = foto.substr(12, foto.length);
        foto = fechaPublicacion + foto;
    }

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
                if (foto !== "") {
                    guardarFotoPost(fechaPublicacion, foto, form_data);
                }
            } else {
                alert("ERROR: Se ha producido un error");
            }
        }
    });
}

function guardarFotoPost(fechaPublicacion, foto, rutaFoto) {

    $.ajax({
        url: "../dao/saveFoto.php",
        type: "POST",
        data: {
            fechaPublicacion: fechaPublicacion,
            foto: foto
        },
        cache: false,
        success: function (dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
            } else {
                alert("ERROR: Se ha producido un error");
            }
        }
    });

    $.ajax({
        url: "../dao/uploadFoto.php",
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: rutaFoto,
        type: 'post',
        success: function (dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#fotoPost').val('');
            } else {
                alert("ERROR: No se ha podido subir su foto");
                $('#fotoPost').val('');
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

function comprobarFollow(user, userEnc) {

    var txtBoton = $("#btnFollow").text();
    txtBoton = txtBoton.replace(/\s+/g, '');

    if (txtBoton === "Seguir") {
        $.ajax({
            url: "../dao/follow.php",
            type: "POST",
            data: {
                idUsuario: userEnc,
                idSeguidor: user
            },
            cache: false,
            success: function (dataResult) {
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == 200) {
                    $('#btnFollow').html('Siguiendo');
                } else {
                    alert("ERROR: Se ha producido un error");
                }
            }
        });
    } else {
        $.ajax({
            url: "../dao/unfollow.php",
            type: "POST",
            data: {
                idUsuario: userEnc,
                idSeguidor: user
            },
            cache: false,
            success: function (dataResult) {
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == 200) {
                    $('#btnFollow').html('Seguir');
                } else {
                    alert("ERROR: Se ha producido un error");
                }
            }
        });
    }
}