<?php

require_once '../modelo/carta.php';

class daoCarta {

    var $conn;
    var $objCarta;

    public function registrar($objCarta) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");

        $idUsuaio = $objCarta->getNick();
        $nombre = $objCarta->getPassword();

        $sql = "INSERT INTO carta(idCarta, idUsuario, nombeCarta) VALUES (null,'$idUsuaio','$nombre')";

        if (!$conn->query($sql)) {
            return false;
        } else {
            return true;
        }

        mysqli_close($conn);
    }

    public function obtenerDatosCarta($idUsuario) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "SELECT * FROM carta WHERE idUsuario='$idUsuario'";

        $result = $conn->query($sql);
        $cartaAux = mysqli_fetch_assoc($result);

        mysqli_close($conn);
        return $cartaAux;
    }

    public function renombrar($nuevoNombre, $idUsuario) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");

        $sql = "UPDATE grumble.carta SET nombreCarta='" . $nuevoNombre . "' WHERE idUsuario='$idUsuario'";

        if (!$conn->query($sql)) {
            return false;
        } else {
            return true;
        }

        mysqli_close($conn);
    }
}
