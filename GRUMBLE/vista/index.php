<?php
session_start();
$_SESSION['usuario'] = 1;
$_SESSION['userBuscado'] = 2;
require_once '../dao/daoSeguidor.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Indice</title>
        <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="../js/index.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col" id="colBotones">
                    <button id="confProfesional" onclick="redirigirProfesional()">Editar Profesional</button>
                    <br/><br/>
                    <button id="confParticular" onclick="redirigirParticular()">Editar Particular</button>
                    <br/><br/>
                    <button id="myGallery" onclick="redirigirGaleria()">Mis fotos</button>
                    <br/><br/>
                    <button id="resenya" onclick="redirigirResenya()">Hacer reseña</button>
                    <br/><br/>
                    <button id="carta" onclick="redirigirCarta()">Carta</button>
                    <br/><br/>
                    <?php
                    $objSeguidor = new daoSeguidor();
                    $siguiendo = false;
                    $idUsuario = $_SESSION['usuario'];
                    $idUserEnc = $_SESSION['userBuscado'];

                    $listaSeguidos = $objSeguidor->listaDeSeguidos($idUsuario);
                    //print_r($listaSeguidos);
                    if (sizeof($listaSeguidos) > 0) {
                        $enc = false;
                        $i = 0;
                        while (!$enc) {
                            if ($listaSeguidos[$i]['idUsuario'] == $idUserEnc) {
                                $enc = true;
                                $siguiendo = true;
                            } else {
                                $i++;
                            }
                        }
                    } else {
                        $siguiendo = false;
                    }
                    ?>
                    <button id="btnFollow" class="btn btn-primary" onclick="comprobarFollow(<?php echo $idUsuario; ?>,<?php echo $idUserEnc; ?>)">
                        <?php
                        if ($siguiendo) {
                            echo "Siguiendo";
                        } else {
                            echo "Seguir";
                        }
                        ?>
                    </button>
                </div>
                <div class="col" id="colPost">
                    <div class="alert alert-success alert-dimissible" id="success" style="display:none;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                    </div>
                    <span class="badge badge-pill">POST</span>
                    <textarea id="txtPost" name="txtPost" rows="2" cols="40" placeholder="¿Alguna novedad?" onkeyup="comprobarTextArea(this)"></textarea>
                    <input type="file" class="form-control-file" id="fotoPost">
                    <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $_SESSION['usuario']; ?>">
                    <button id="btnPublicar" class="btn btn-primary" onclick="guardarPost()">Publicar</button>
                </div>
                <div class="col" id="colPluggins">
                </div>
            </div>
        </div>
    </body>
</html>
