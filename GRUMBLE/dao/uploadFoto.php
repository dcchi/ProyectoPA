<?php

if (0 < $_FILES['file']['error']) {
    echo json_encode(array("statusCode" => 201));
} else {
    if (($_FILES['file']['type'] != "image/jpeg") && ($_FILES['file']['type'] != "image/png")) {
        echo json_encode(array("statusCode" => 201));
    } else if ((($_FILES['file']['size']/1024) > 4096)) {
        echo json_encode(array("statusCode" => 201));
    } else {
        $rutaFoto = "../fotoPost/" . $_POST['fecha'] . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], '../fotoPost/' . $rutaFoto);
        echo json_encode(array("statusCode" => 200));
    }
}