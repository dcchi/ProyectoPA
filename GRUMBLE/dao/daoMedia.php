<?php

require_once '../modelo/media.php';

class daoMedia {

    var $conn;
    var $objMedia;

    public function listar() {

        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "SELECT * FROM media";

        $result = $conn->query($sql);
        $arrayMedia = array();

        while ($fila = mysqli_fetch_assoc($result)) {
            array_push($arrayMedia, $fila);
        }

        mysqli_close($conn);
        return $arrayMedia;
    }
}
