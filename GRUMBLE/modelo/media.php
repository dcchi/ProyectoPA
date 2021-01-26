<?php

class Media {

    public $id;
    public $idPost;
    public $foto;

    public function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getIdPost() {
        return $this->idPost;
    }

    function getFoto() {
        return $this->foto;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdPost($idPost) {
        $this->idPost = $idPost;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function __toString() {
        return $this->id . $this->idPost . $this->foto;
    }
}
