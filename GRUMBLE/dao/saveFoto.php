<?php

$conn = mysqli_connect("localhost", "root", "", "grumble");

$foto = $_POST['foto'];
$fecha = $_POST['fechaPublicacion'];


$sqlPost = "SELECT * FROM post WHERE fecha='$fecha'";
$result = $conn->query($sqlPost);
$aux = mysqli_fetch_assoc($result);
$idPost = $aux['idPost'];

$sql = "INSERT INTO media(id, idPost, foto) VALUES (null,'$idPost','$foto')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}

mysqli_close($conn);
