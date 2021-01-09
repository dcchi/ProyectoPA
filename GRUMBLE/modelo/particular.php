<?php

class Particular {

    public $idUsuario;
    public $nombre;
    public $apellidos;
    public $sexo;
    public $fechaNacimiento;
    public $foto;

    public function __construct() {
        
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    function getFoto() {
        return $this->foto;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function __toString() {
        return $this->idUsuario . $this->nombre . $this->apellidos . $this->sexo . $this->fechaNacimiento . $this->foto;
    }

}
