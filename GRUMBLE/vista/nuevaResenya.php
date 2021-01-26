<?php
session_start();
$_SESSION['usuario'] = 1;
if ($_SESSION['usuario']) {
    require_once '../modelo/resenya.php';
    require_once '../modelo/profesional.php';
    require_once '../modelo/usuario.php';
    require_once '../dao/daoResenya.php';
    require_once '../dao/daoProfesional.php';
    require_once '../dao/daoUsuario.php';
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Grumble</title>
            <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link type="text/css" href="../css/cssCongPro.css" rel="stylesheet">
            <link rel="stylesheet" href="../css/font-awesome.min.css">
            <link rel="stylesheet" href="../css/styles.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
            <script src="../js/jquery.rating.pack.js"</script>
            <script src="../js/resenya.js" type="text/javascript"></script>
            <script>
                $(document).ready(function () {
                    $('input.star').rating();
                });
            </script>
        </head>
        <body>
            <?php
            if (!isset($_POST['btnAdd']) && !isset($_POST['btnCancelar'])) {
                ?>
                <div class='container'>
                    <div class='row'>
                        <div class="col"></div>
                        <div class='col'>
                            <h2 class="display-4">Reseña</h2>
                            <form action="nuevaResenya.php" id="resenyaForm" method="POST" enctype="multipart/form-data" onsubmit="return validar();">
                                <div class="form-group row">
                                    <div class='col'>
                                        <label for="resProfesional">Restaurante/Bar</label>
                                        <select class="form-control" id="resProfesional" name="resProfesional">
                                            <option value="0">No seleccionado</option>
                                            <?php
                                            $objUsuario = new daoUsuario();
                                            $arrayProfesionales = $objUsuario->listarTipo("M");
                                            if (sizeof($arrayProfesionales) > 0) {
                                                for ($i = 0; $i < sizeof($arrayProfesionales); $i++) {
                                                    $profesionalAux = $arrayProfesionales[$i];
                                                    ?>
                                                    <option value="<?php echo $profesionalAux['nickName']; ?>"><?php echo $profesionalAux['nickName']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="nohay">No hay</option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class='col'>
                                        <label for="platos">¿Cuantos platos tomó?</label>
                                        <input type="number" id="numPlatos" name="numPlatos" class="form-control" value="1">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class='col'>
                                        <label for="txtResenya">Sugerencias</label>
                                        <textarea id="txtResenya" name="txtResenya" class="form-control" rows="2" cols="30"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class='col'>
                                        <label for="valoracion">Valoracion</label>
                                        <div class="star_content">
                                            <input name="rate" value="1" type="radio" class="star" checked="checked"/> 
                                            <input name="rate" value="2" type="radio" class="star"/> 
                                            <input name="rate" value="3" type="radio" class="star"/> 
                                            <input name="rate" value="4" type="radio" class="star"/> 
                                            <input name="rate" value="5" type="radio" class="star"/>
                                        </div>
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
            header("location:index.php");
        } else if (isset($_POST['btnAdd']) && !isset($_POST['btnCancelar'])) {
            $idUsuario = $_SESSION['usuario'];
            $profesional = $_POST['resProfesional'];
            $numPlatos = $_POST['numPlatos'];
            $txtResenya = $_POST['txtResenya'];
            $valoracion = $_POST['rate'];
            $fecha = date('Y-m-d');

            $nuevaResenya = new Resenya();
            $objResenya = new daoResenya();
            $objUsuario2 = new daoUsuario();
            $userAux = $objUsuario2->getUsuario($profesional);
            $idProfesional = $userAux['idUsuario'];

            $nuevaResenya->setIdParticular($idUsuario);
            $nuevaResenya->setIdProfesional($idProfesional);
            $nuevaResenya->setPlatos($numPlatos);
            $nuevaResenya->setValoracion($valoracion);
            $nuevaResenya->setMensaje($txtResenya);
            $nuevaResenya->setFechaResenya($fecha);

            $objResenya->registrar($nuevaResenya);
            ?>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Receta Añadida</h4>
                <p>La receta ha sido registrada correctamente</p>
            </div>
            <?php
            header("refresh:3;url=index.php");
        }
        ?>
    </body>
    </html>
    <?php
}