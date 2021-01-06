<?php

class Profesional {

    public $idUsuario;
    public $direccion;
    public $nombreDuenyo;
    public $telefono;
    public $fechaCreacion;
    public $foto;

    public function __construct() {
        
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getNombreDuenyo() {
        return $this->nombreDuenyo;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    function getFoto() {
        return $this->foto;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setNombreDuenyo($nombreDuenyo) {
        $this->nombreDuenyo = $nombreDuenyo;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function __toString() {
        return $this->idUsuario . $this->direccion . $this->nombreDuenyo . $this->telefono . $this->fechaCreacion . $this->foto;
    }

}
