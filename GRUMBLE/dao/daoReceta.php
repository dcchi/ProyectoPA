<?php

require_once '../modelo/receta.php';

class daoReceta {

    var $conn;
    var $objReceta;

    public function registrar($objReceta) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");

        $idCarta = $objReceta->getIdCarta();
        $idUsuario = $objReceta->getIdUsuario();
        $nombreReceta = $objReceta->getNombreReceta();
        $foto = $objReceta->getFoto();
        $tipo = $objReceta->getTipo();

        if ($foto != "") {
            $sql = "INSERT INTO receta(idReceta, idCarta, idUsuario, nombreReceta, foto, tipo) VALUES (null,'$idCarta','$idUsuario','$nombreReceta','$foto','$tipo')";
        } else {
            $sql = "INSERT INTO receta(idReceta, idCarta, idUsuario, nombreReceta, tipo) VALUES (null,'$idCarta','$idUsuario','$nombreReceta','$tipo')";
        }
        if (!$conn->query($sql)) {
            return false;
        } else {
            return true;
        }

        mysqli_close($conn);
    }

    public function obtenerDatos($idReceta) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "SELECT * FROM receta WHERE idReceta='$idReceta'";

        $result = $conn->query($sql);
        $recetaAux = mysqli_fetch_assoc($result);

        mysqli_close($conn);
        return $recetaAux;
    }
    
    public function obtenerDatosXIdUsuario($idUsuario) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "SELECT * FROM receta WHERE idUsuario='$idUsuario'";

        $result = $conn->query($sql);
        $recetaAux = mysqli_fetch_assoc($result);

        mysqli_close($conn);
        return $recetaAux;
        
        
    }

    public function obtenerIdRecetas($idCarta) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "SELECT idReceta FROM receta WHERE idCarta='$idCarta'";

        $result = $conn->query($sql);
        $recetaAux = mysqli_fetch_assoc($result);

        mysqli_close($conn);
        return $recetaAux;
    }

    public function obtenerRecetaXTipoYUsuario($tipo, $idUsuario) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "SELECT * FROM receta WHERE (tipo='$tipo' AND idUsuario='$idUsuario')";

        $result = $conn->query($sql);
        $arrayRecetas = array();

        while ($fila = mysqli_fetch_assoc($result)) {
            array_push($arrayRecetas, $fila);
        }

        mysqli_close($conn);
        return $arrayRecetas;
    }

    public function obtenerRecetaXTipoYCarta($tipo, $idCarta) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "SELECT * FROM receta WHERE (tipo='$tipo' AND idCarta='$idCarta')";

        $result = $conn->query($sql);
        $arrayRecetas = array();

        while ($fila = mysqli_fetch_assoc($result)) {
            array_push($arrayRecetas, $fila);
        }

        mysqli_close($conn);
        return $arrayRecetas;
    }
    
    public function actualizarIdCarta($nombreReceta, $idUsuario, $idCarta) {
        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "UPDATE receta SET idCarta='$idCarta' WHERE (idUsuario='$idUsuario' AND nombreReceta='$nombreReceta')";

        if (!$conn->query($sql)) {
            return false;
        } else {
            return true;
        }
        mysqli_close($conn);
    }

    public function eliminarReceta($nombreReceta, $idUsuario) {
        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "UPDATE receta SET idCarta='0' WHERE (idUsuario='$idUsuario' AND nombreReceta='$nombreReceta')";

        if (!$conn->query($sql)) {
            return false;
        } else {
            return true;
        }
        mysqli_close($conn);
    }

}
