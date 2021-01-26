<?php

$conn = mysqli_connect("localhost", "root", "", "grumble");

$idUsuario = $_POST['idUsuario'];
$idSeguidor = $_POST['idSeguidor'];

$sql = "DELETE FROM seguidor WHERE idUsuario='$idUsuario' AND idSeguidor='$idSeguidor'";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);
