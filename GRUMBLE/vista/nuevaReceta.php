<?php
session_start();
$_SESSION['usuario'] = 1;
if ($_SESSION['usuario']) {
    require_once '../modelo/carta.php';
    require_once '../dao/daoCarta.php';
    require_once '../modelo/receta.php';
    require_once '../dao/daoReceta.php';
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Crear receta</title>
            <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link type="text/css" href="../css/cssCongPro.css" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="../js/receta.js" type="text/javascript"></script>
        </head>
        <body>
            <?php
            if (!isset($_POST['btnAdd']) && !isset($_POST['btnCancelar'])) {
                ?>
                <br/><br/>
                <div class='container'>
                    <div class='row'>
                        <div class="col"></div>
                        <div class='col'>
                            <h1 class="display-4">Añadir receta</h1>
                            <form action="nuevaReceta.php" id="recetaForm" method="POST" enctype="multipart/form-data" onsubmit="return validar();">
                                <div class="form-group row">
                                    <div class='col'>
                                        <label for="nombreReceta">Nombre receta</label>
                                        <input type="text" name="nombreReceta" id="nombreReceta" class="form-control" placeholder="Nombre receta..." onfocus="conFoco(this)" onblur="sinFoco(this)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class='col'>
                                        <label for="tipo">Tipo</label>
                                        <select class="form-control" id="tipo" name="tipo">
                                            <option value="Entrante">Entrantes</option>
                                            <option value="Primeros">Primeros</option>
                                            <option value="Segundos">Segundos</option>
                                            <option value="Postres">Postres</option>
                                            <option value="Bebidas">Bebidas</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class='col'>
                                        <label for="foto" class="label label-default">Foto</label><br/>
                                        <input type="file" name="foto" value="null"/>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-light" name="btnAdd" value="Añadir"/>
                                <button type="button" class="btn btn-light" name="btnCancelar" onclick="volver()">Cancelar</button> <br><br>
                            </form>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
            </div>
            <?php
        } else if (!isset($_POST['btnAdd']) && isset($_POST['btnCancelar'])) {
            header("location:carta.php");
        } else if (isset($_POST['btnAdd']) && !isset($_POST['btnCancelar'])) {
            $idUsuario = $_SESSION['usuario'];
            $nombreReceta = $_POST['nombreReceta'];
            $tipo = $_POST['tipo'];

            if ($_FILES['foto']['name'] != null) {
                array_map('unlink', array_filter((array) glob("../img/*")));
                $foto = $_FILES['foto']['name'];
                $tiempo = new DateTime();
                $nuevaFoto = date_timestamp_get($tiempo) . $_FILES['foto']['name'];
                $rutaFoto = "../img/" . $nuevaFoto;
                move_uploaded_file($_FILES['foto']['tmp_name'], $rutaFoto);
            } else {
                $nuevaFoto = "";
            }

            $nuevaReceta = new Receta();
            $objReceta = new daoReceta();

            $nuevaReceta->setIdCarta(null);
            $nuevaReceta->setIdUsuario($idUsuario);
            $nuevaReceta->setNombreReceta($nombreReceta);
            $nuevaReceta->setTipo($tipo);
            $nuevaReceta->setFoto($nuevaFoto);

            $objReceta->registrar($nuevaReceta);
            ?>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Receta Añadida</h4>
                <p>La receta ha sido registrada correctamente</p>
            </div>
            <?php
            header("refresh:3;url=carta.php");
        }
        ?>
    </body>
    </html>
    <?php
}