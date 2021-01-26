<?php

class Seguidor {

    public $idUsuario;
    public $idSeguidor;

    public function __construct() {
        
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdSeguidor() {
        return $this->idSeguidor;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setIdSeguidor($idSeguidor) {
        $this->idPost = $idSeguidor;
    }

    function __toString() {
        return $this->idUsuario . $this->idSeguidor;
    }

}
