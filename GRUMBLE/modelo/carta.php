<?php

class Carta {

    public $idCarta;
    public $idUsuario;
    public $nombreCarta;


    public function __construct() {
        
    }

    function getIdCarta() {
        return $this->idCarta;
    }
    
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getNombreCarta() {
        return $this->nombreCarta;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setIdCarta($idCarta) {
        $this->idCarta = $idCarta;
    }

    function setNombreCarta($nombreCarta) {
        $this->nombreCarta = $nombreCarta;
    }

    function __toString() {
        return $this->idCarta . $this->idUsuario . $this->nombreCarta;
    }

}
