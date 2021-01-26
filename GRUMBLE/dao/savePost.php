<?php

$conn = mysqli_connect("localhost", "root", "", "grumble");

$idUsuario = $_POST['idUsuario'];
$mensaje = $_POST['mensaje'];
$fecha = $_POST['fechaPublicacion'];

if ($mensaje == "") {
    echo json_encode(array("statusCode" => 201));
} else {
    $sql = "INSERT INTO post(idPost, idUsuario, mensaje, fecha) VALUES (null,'$idUsuario','$mensaje','$fecha')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
}

    