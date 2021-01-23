<?php

require_once '../modelo/post.php';

class daoPost {

    var $conn;
    var $objPost;

    public function listar() {

        $conn = mysqli_connect("localhost", "root", "", "grumble");
        $sql = "SELECT * FROM post";

        $result = $conn->query($sql);
        $arrayPost = array();

        while ($fila = mysqli_fetch_assoc($result)) {
            array_push($arrayPost, $fila);
        }

        mysqli_close($conn);
        return $arrayPost;
    }

}
