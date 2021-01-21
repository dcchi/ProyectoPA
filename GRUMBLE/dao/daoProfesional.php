<?php

require_once '../modelo/profesional.php';

class daoProfesional {

    var $conn;
    var $objProfesional;

    public function actualizar($objProfesional) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");

        $idUsuario = $objProfesional->getIdUsuario();
        $direccion = $objProfesional->getDireccion();
        $nombreDuenyo = $objProfesional->getNombreDuenyo();
        $telefono = $objProfesional->getTelefono();
        $fechaCreacion = $objProfesional->getFechaCreacion();
        $foto = $objProfesional->getFoto();

        if($foto != ""){
        $sql = "UPDATE grumble.profesional SET direccion='".$direccion."',nombreDuenyo='".$nombreDuenyo."',telefono='".$telefono."',fechaCreacion='".$fechaCreacion."',foto='".$foto."' WHERE idUsuario='$idUsuario'";
        } else {
        $sql = "UPDATE grumble.profesional SET direccion='".$direccion."',nombreDuenyo='".$nombreDuenyo."',telefono='".$telefono."',fechaCreacion='".$fechaCreacion."' WHERE idUsuario='$idUsuario'";
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
        $sql = "SELECT * FROM profesional";

        $result = $conn->query($sql);
        $arrayProfesional = array();

        while ($fila = mysqli_fetch_assoc($result)) {
            array_push($arrayProfesional, $fila);
        }

        mysqli_close($conn);
        return $arrayProfesional;
    }

    public function obtenerDatosProfesional($idUsuario) {

        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "SELECT * FROM profesional WHERE idUsuario='$idUsuario'";

        $result = $conn->query($sql);
        $profesionalAux = mysqli_fetch_assoc($result);

        mysqli_close($conn);
        return $profesionalAux;
    }

}
