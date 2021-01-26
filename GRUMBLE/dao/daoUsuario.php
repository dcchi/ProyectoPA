<?php

require_once '../modelo/usuario.php';

class daoUsuario {

    var $conn;
    var $objUsuario;

    public function registrar($objUsuario) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");

        $nick = $objUsuario->getNick();
        $password = $objUsuario->getPassword();
        $email = $objUsuario->getEmail();
        $tipo = $objUsuario->getTipo();

        $sql = "INSERT INTO usuario(id, nickName, email, password, tipo) VALUES (null,'$nick','$email','$password','$tipo')";

        if (!$conn->query($sql)) {
            return false;
        } else {
            return true;
        }

        mysqli_close($conn);
    }

    public function obtenerDatos($idUsuario) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "SELECT * FROM usuario WHERE idUsuario='$idUsuario'";

        $result = $conn->query($sql);
        $userAux = mysqli_fetch_assoc($result);

        mysqli_close($conn);
        return $userAux;
    }

    public function actualizar($objUsuario) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");

        $idUsuario = $objUsuario->getIdUsuario();
        $nick = $objUsuario->getNick();
        $password = $objUsuario->getPassword();
        $email = $objUsuario->getEmail();


        if ($password != "") {
            $sql = "UPDATE grumble.usuario SET nickName='" . $nick . "',email='" . $email . "',password='" . $password . "' WHERE idUsuario='$idUsuario'";
        } else {
            $sql = "UPDATE grumble.usuario SET nickName='" . $nick . "',email='" . $email . "' WHERE idUsuario='$idUsuario'";
        }
        if (!$conn->query($sql)) {
            return false;
        } else {
            return true;
        }

        mysqli_close($conn);
    }

    public function getUsuario($nombreUsuario) {
        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "SELECT * FROM usuario WHERE nickName='$nombreUsuario'";

        $result = $conn->query($sql);
        $userAux = mysqli_fetch_assoc($result);

        mysqli_close($conn);
        return $userAux;
    }

    public function listarTipo($tipo) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "SELECT * FROM usuario WHERE tipo='$tipo'";

        $result = $conn->query($sql);
        $arrayUsuario = array();

        while ($fila = mysqli_fetch_assoc($result)) {
            array_push($arrayUsuario, $fila);
        }

        mysqli_close($conn);
        return $arrayUsuario;
    }
}
