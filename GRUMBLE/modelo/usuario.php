<?php

class Usuario {

    public $idUsuario;
    public $nick;
    public $password;
    public $email;
    public $tipo;

    public function __construct() {
        
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getNick() {
        return $this->nick;
    }

    function getPassword() {
        return $this->password;
    }

    function getEmail() {
        return $this->email;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setNick($nick) {
        $this->nick = $nick;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function __toString() {
        return $this->idUsuario . $this->nick . $this->password . $this->email . $this->tipo;
    }

}
