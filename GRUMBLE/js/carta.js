function crearNuevaReceta() {
    document.location.href = 'nuevaReceta.php';
}

function addReceta(idSelect) {

    var valorSelect = $('#' + idSelect).val();
    var listaReceta = document.getElementById('lista' + idSelect).getElementsByTagName('li');
    var arrayReceta = Array.from(listaReceta);
    var existe = false;

    for (var i = 0; i < arrayReceta.length; i++) {
        if (arrayReceta[i].textContent === valorSelect) {
            existe = true;
        }
    }

    if (!existe) {
        var nuevaRecetaInput = "<input type='hidden' name='receta[]' value='" + valorSelect + "'>";
        var listaInputs = document.getElementById('cartaForm').getElementsByTagName('input');
        var arrayInputs = Array.from(listaInputs);
        $(arrayInputs[arrayInputs.length - 3]).after(nuevaRecetaInput);

        var nuevaRecetaLista = "<li id='" + valorSelect + "'>" + valorSelect + "</li>";
        var btnEliminar = "<button onclick='eliminar(" + valorSelect + ")'>Eliminar</button>";

        var listaBotones = document.getElementById('lista' + idSelect).getElementsByTagName('button');
        var arrayBotones = Array.from(listaBotones);
        if (arrayBotones.length === 0) {
            $('#lista' + idSelect).append(nuevaRecetaLista);
        } else {
            $(arrayBotones[arrayBotones.length - 1]).after(nuevaRecetaLista);
        }
        $('#' + valorSelect).after(btnEliminar);
    } else {
        alert("El plato " + valorSelect + " ya se encuentra en la carta");
    }
}

function eliminar(nombreReceta) {

    var txtNombreReceta = nombreReceta.textContent;
    var recetaEliminada = "<input type='hidden' name='eliminar[]' value='" + txtNombreReceta + "'>";
    var listaInputs = document.getElementById('cartaForm').getElementsByTagName('input');
    var arrayInputs = Array.from(listaInputs);
    $(arrayInputs[arrayInputs.length - 3]).after(recetaEliminada);

    var btnNext = $('#' + txtNombreReceta).next();
    btnNext.remove();
    nombreReceta.remove();
}