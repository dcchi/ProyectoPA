<?php

class Resenya {

    public $idResenya;
    public $idParticular;
    public $idProfesional;
    public $platos;
    public $mensaje;
    public $valoracion;
    public $fechaResenya;

    public function __construct() {
        
    }

    function getIdResenya() {
        return $this->idResenya;
    }

    function getIdParticular() {
        return $this->idParticular;
    }

    function getIdProfesional() {
        return $this->idProfesional;
    }

    function getPlatos() {
        return $this->platos;
    }

    function getMensaje() {
        return $this->mensaje;
    }

    function getValoracion() {
        return $this->valoracion;
    }

    function getFechaResenya() {
        return $this->fechaResenya;
    }

    function setIdResenya($idResenya) {
        $this->idResenya = $idResenya;
    }

    function setIdParticular($idParticular) {
        $this->idParticular = $idParticular;
    }

    function setIdProfesional($idProfesional) {
        $this->idProfesional = $idProfesional;
    }

    function setPlatos($platos) {
        $this->platos = $platos;
    }

    function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    function setValoracion($valoracion) {
        $this->valoracion = $valoracion;
    }

    function setFechaResenya($fechaResenya) {
        $this->fechaResenya = $fechaResenya;
    }

    function __toString() {
        return $this->idResenya . $this->idParticular . $this->idProfesional . $this->platos . $this->mensaje . $this->valoracion . $this->fechaResenya;
    }

}
