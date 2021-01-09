<?php

require_once '../modelo/particular.php';

class daoParticular {

    var $conn;
    var $objParticular;

    public function actualizar($objParticular) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");

        $idUsuario = $objParticular->getIdUsuario();
        $nombre = $objParticular->getNombre();
        $apellidos = $objParticular->getApellidos();
        $sexo = $objParticular->getSexo();
        $fechaNacimiento = $objParticular->getFechaNacimiento();
        $foto = $objParticular->getFoto();

        if($foto != ""){
        $sql = "UPDATE grumble.particular SET nombre='".$nombre."',apellidos='".$apellidos."',sexo='".$sexo."',fechaNacimiento='".$fechaNacimiento."',foto='".$foto."' WHERE idUsuario='$idUsuario'";
        } else {
        $sql = "UPDATE grumble.particular SET nombre='".$nombre."',apellidos='".$apellidos."',sexo='".$sexo."',fechaNacimiento='".$fechaNacimiento."' WHERE idUsuario='$idUsuario'";
        }
        if (!$conn->query($sql)) {
            return false;
        } else {
            return true;
        }

        mysqli_close($conn);
    }

    public function listar() {

        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "SELECT * FROM particular";

        $result = $conn->query($sql);
        $arrayParticular = array();

        while ($fila = mysqli_fetch_assoc($result)) {
            array_push($arrayParticular, $fila);
        }

        mysqli_close($conn);
        return $arrayParticular;
    }

    public function obtenerDatosParticular($idUsuario) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "SELECT * FROM particular WHERE idUsuario='$idUsuario'";

        $result = $conn->query($sql);
        $particularAux = mysqli_fetch_assoc($result);

        mysqli_close($conn);
        return $particularAux;
    }

}
