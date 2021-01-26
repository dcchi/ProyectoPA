<?php

require_once '../modelo/resenya.php';

class daoResenya {

    var $conn;
    var $objResenya;

    public function registrar($objResenya) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");

        $idParticular = $objResenya->getIdParticular();
        $idProfesional = $objResenya->getIdProfesional();
        $platos = $objResenya->getPlatos();
        $mensaje = $objResenya->getMensaje();
        $valoracion = $objResenya->getValoracion();
        $fechaResenya = $objResenya->getFechaResenya();

        if ($mensaje != "") {
            $sql = "INSERT INTO reseña(idResenya, idParticular, idProfesional, platos, mensaje, valoracion, fecha) VALUES (null,'$idParticular','$idProfesional','$platos','$mensaje','$valoracion','$fechaResenya')";
        } else {
            $sql = "INSERT INTO reseña(idResenya, idParticular, idProfesional, platos, mensaje, valoracion, fecha) VALUES (null,'$idParticular','$idProfesional','$platos',null,'$valoracion','$fechaResenya')";
        }
        if (!$conn->query($sql)) {
            return false;
        } else {
            return true;
        }

        mysqli_close($conn);
    }

    public function listarIdProfesional($idProfesional) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "SELECT * FROM reseña WHERE idProfesional='$idProfesional'";

        $result = $conn->query($sql);
        $arrayProfesional = array();

        while ($fila = mysqli_fetch_assoc($result)) {
            array_push($arrayProfesional, $fila);
        }

        mysqli_close($conn);
        return $arrayProfesional;
    }

}
