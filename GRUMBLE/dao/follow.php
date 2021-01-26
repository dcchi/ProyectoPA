<?php

$conn = mysqli_connect("localhost", "root", "", "grumble");

$idUsuario = $_POST['idUsuario'];
$idSeguidor = $_POST['idSeguidor'];

$sql = "INSERT INTO seguidor(id, idUsuario, idSeguidor) VALUES (null, '$idUsuario','$idSeguidor')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);
