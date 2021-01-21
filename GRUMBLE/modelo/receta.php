<?php

class Receta {

    public $idReceta;
    public $idCarta;
    public $idUsuario;
    public $nombreReceta;
    public $foto;
    public $tipo;

    public function __construct() {
        
    }

    function getIdReceta() {
        return $this->idReceta;
    }

    function getIdCarta() {
        return $this->idCarta;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getNombreReceta() {
        return $this->nombreReceta;
    }

    function getFoto() {
        return $this->foto;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setIdReceta($idReceta) {
        $this->idReceta = $idReceta;
    }

    function setIdCarta($idCarta) {
        $this->idCarta = $idCarta;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setNombreReceta($nombreReceta) {
        $this->nombreReceta = $nombreReceta;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function __toString() {
        return $this->idReceta . $this->idCarta . $this->idUsuario . $this->nombreReceta . $this->foto . $this->foto;
    }

}
