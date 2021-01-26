<?php

require_once '../modelo/seguidor.php';

class daoSeguidor {

    var $conn;
    var $objSeguidor;

    public function listarSeguidores($idUsuario) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "SELECT * FROM seguidor WHERE idUsuario='$idUsuario'";

        $result = $conn->query($sql);
        $arraySeguidores = array();

        while ($fila = mysqli_fetch_assoc($result)) {
            array_push($arraySeguidores, $fila);
        }

        mysqli_close($conn);
        return $arraySeguidores;
    }

    public function listaDeSeguidos($idUsuario) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "SELECT * FROM seguidor WHERE idSeguidor='$idUsuario'";

        $result = $conn->query($sql);
        $arraySeguidores = array();

        while ($fila = mysqli_fetch_assoc($result)) {
            array_push($arraySeguidores, $fila);
        }

        mysqli_close($conn);
        return $arraySeguidores;
    }

}
