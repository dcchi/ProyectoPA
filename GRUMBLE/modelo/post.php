<?php

class Post {

    public $idPost;
    public $idUsuario;
    public $mensaje;
    public $fecha;

    public function __construct() {
        
    }

    function getIdPost() {
        return $this->idPost;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getMensaje() {
        return $this->mensaje;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setIdPost($idPost) {
        $this->idPost = $idPost;
    }

    function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function __toString() {
        return $this->idPost . $this->idUsuario . $this->mensaje . $this->fecha;
    }

}
