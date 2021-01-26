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
            <title>Carta</title>
            <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="../js/carta.js" type="text/javascript"></script>
        </head>
        <body>
            <?php
            if (!isset($_POST['btnActualizar']) && !isset($_POST['btnVolver'])) {
                $objCarta = new daoCarta();
                $cartaAux = $objCarta->obtenerDatosCarta($_SESSION['usuario']);
                $idCarta = $cartaAux['idCarta'];
                $nombreCarta = $cartaAux['nombreCarta'];
                ?>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col">
                            <h2>Carta <?php echo $nombreCarta; ?></h2>
                        </div>
                        <div class="col">
                            <button  type="button" class="btn btn-primary" onclick="crearNuevaReceta()">Crear nueva receta</button>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row">
                        <div class="col" id="colEntrantes">
                            Entrantes
                            <select class="form-control" id="Entrantes">
                                <?php
                                $objRecetas = new daoReceta();
                                $listaRecetasEntrantes = $objRecetas->obtenerRecetaXTipoYUsuario("Entrante", $_SESSION['usuario']);
                                for ($i = 0; $i < sizeof($listaRecetasEntrantes); $i++) {
                                    $nombrePlato = $listaRecetasEntrantes[$i]["nombreReceta"];
                                    ?>
                                    <option><?php echo $nombrePlato; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <button type="button" class="btn btn-light" id="btnEntrante" onclick="addReceta('Entrantes')">Añadir</button>
                            <br/><br/>
                            <ol id="listaEntrantes">
                                <?php
                                $listaCaraEntrantes = $objRecetas->obtenerRecetaXTipoYCarta("Entrante", $idCarta);
                                for ($i = 0; $i < sizeof($listaCaraEntrantes); $i++) {
                                    $nombrePlato = $listaCaraEntrantes[$i]["nombreReceta"];
                                    ?>
                                    <li id="<?php echo $nombrePlato; ?>"><?php echo $nombrePlato; ?></li>
                                    <button onclick="eliminar(<?php echo $nombrePlato; ?>)">Eliminar</button>
                                    <?php
                                }
                                ?>
                            </ol>
                        </div>
                        <div class="col" id="colPrimeros">
                            Primeros
                            <select class="form-control" id="Primeros">
                                <?php
                                $listaRecetasPrimeros = $objRecetas->obtenerRecetaXTipoYUsuario("Primeros", $_SESSION['usuario']);
                                for ($i = 0; $i < sizeof($listaRecetasPrimeros); $i++) {
                                    $nombrePlato = $listaRecetasPrimeros[$i]["nombreReceta"];
                                    ?>
                                    <option><?php echo $nombrePlato; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <button type="button" class="btn btn-light" id="btnPrimero" onclick="addReceta('Primeros')">Añadir</button>
                            <br/><br/>
                            <ol id="listaPrimeros">
                                <?php
                                $listaCaraPrimeros = $objRecetas->obtenerRecetaXTipoYCarta("Primeros", $idCarta);
                                for ($i = 0; $i < sizeof($listaCaraPrimeros); $i++) {
                                    $nombrePlato = $listaCaraPrimeros[$i]["nombreReceta"];
                                    ?>
                                    <li id="<?php echo $nombrePlato; ?>"><?php echo $nombrePlato; ?></li>
                                    <button onclick="eliminar(<?php echo $nombrePlato; ?>)">Eliminar</button>
                                    <?php
                                }
                                ?>
                            </ol>
                        </div>
                        <div class="col" id="colSegundos">
                            Segundos
                            <select class="form-control" id="Segundos">
                                <?php
                                $listaRecetasSegundos = $objRecetas->obtenerRecetaXTipoYUsuario("Segundos", $_SESSION['usuario']);
                                for ($i = 0; $i < sizeof($listaRecetasSegundos); $i++) {
                                    $nombrePlato = $listaRecetasSegundos[$i]["nombreReceta"];
                                    ?>
                                    <option><?php echo $nombrePlato; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <button type="button" class="btn btn-light" id="btnSegundo" onclick="addReceta('Segundos')">Añadir</button>
                            <br/><br/>
                            <ol id="listaSegundos">
                                <?php
                                $listaCaraSegundos = $objRecetas->obtenerRecetaXTipoYCarta("Segundos", $idCarta);
                                for ($i = 0; $i < sizeof($listaCaraSegundos); $i++) {
                                    $nombrePlato = $listaCaraSegundos[$i]["nombreReceta"];
                                    ?>
                                    <li id="<?php echo $nombrePlato; ?>"><?php echo $nombrePlato; ?></li>
                                    <button onclick="eliminar(<?php echo $nombrePlato; ?>)">Eliminar</button>
                                    <?php
                                }
                                ?>
                            </ol>
                        </div>
                        <div class="col" id="colPostres">
                            Postres
                            <select class="form-control" id="Postres">
                                <?php
                                $listaRecetasPostres = $objRecetas->obtenerRecetaXTipoYUsuario("Postres", $_SESSION['usuario']);
                                for ($i = 0; $i < sizeof($listaRecetasPostres); $i++) {
                                    $nombrePlato = $listaRecetasPostres[$i]["nombreReceta"];
                                    ?>
                                    <option><?php echo $nombrePlato; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <button type="button" class="btn btn-light" id="btnPostre" onclick="addReceta('Postres')">Añadir</button>
                            <br/><br/>
                            <ol id="listaPostres">
                                <?php
                                $listaCaraPostres = $objRecetas->obtenerRecetaXTipoYCarta("Postres", $idCarta);
                                for ($i = 0; $i < sizeof($listaCaraPostres); $i++) {
                                    $nombrePlato = $listaCaraPostres[$i]["nombreReceta"];
                                    ?>
                                    <li id="<?php echo $nombrePlato; ?>"><?php echo $nombrePlato; ?></li>
                                    <button onclick="eliminar(<?php echo $nombrePlato; ?>)">Eliminar</button>
                                    <?php
                                }
                                ?>
                            </ol>
                        </div>
                        <div class="col" id="colBebidas">
                            Bebidas
                            <select class="form-control" id="Bebidas">
                                <?php
                                $listaRecetasBebidas = $objRecetas->obtenerRecetaXTipoYUsuario("Bebidas", $_SESSION['usuario']);
                                for ($i = 0; $i < sizeof($listaRecetasBebidas); $i++) {
                                    $nombrePlato = $listaRecetasBebidas[$i]["nombreReceta"];
                                    ?>
                                    <option><?php echo $nombrePlato; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <button type="button" class="btn btn-light" id="btnBebidas" onclick="addReceta('Bebidas')">Añadir</button>
                            <br/><br/>
                            <ol id="listaBebidas">
                                <?php
                                $listaCaraBebidas = $objRecetas->obtenerRecetaXTipoYCarta("Bebidas", $idCarta);
                                for ($i = 0; $i < sizeof($listaCaraBebidas); $i++) {
                                    $nombrePlato = $listaCaraBebidas[$i]["nombreReceta"];
                                    ?>
                                    <li id="<?php echo $nombrePlato; ?>"><?php echo $nombrePlato; ?></li>
                                    <button onclick="eliminar(<?php echo $nombrePlato; ?>)">Eliminar</button>
                                    <?php
                                }
                                ?>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <form action="carta.php" id="cartaForm" method="POST">
                                <input type="hidden" name="idCarta" value="<?php echo $idCarta; ?>">
                                <input type="hidden" name="receta[]" value="">
                                <input type="hidden" name="eliminar[]" value="">
                                <input type="submit" class="btn btn-dark" name="btnActualizar" value="Actualizar"/>
                                <input type="submit" class="btn btn-dark" name="btnVolver" value="Volver"/>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else if (isset($_POST['btnActualizar']) && !isset($_POST['btnVolver'])) {
                $idCarta = $_POST['idCarta'];
                $objReceta = new daoReceta();
                $idUsuarioAux = $_SESSION['usuario'];

                if ($_POST['receta']) {
                    $nuevasRecetas = $_POST['receta'];
                    for ($i = 0; $i < sizeof($nuevasRecetas); $i++) {
                        $receta = $nuevasRecetas[$i];
                        if ($receta !== "") {
                            $objReceta->actualizarIdCarta($receta, $idUsuarioAux, $idCarta);
                        }
                    }
                }
                if ($_POST['eliminar']) {
                    $recetasEliminadas = $_POST['eliminar'];
                    for ($i = 0; $i < sizeof($recetasEliminadas); $i++) {
                        $receta = $recetasEliminadas[$i];
                        if ($receta !== "") {
                            $objReceta->eliminarReceta($receta, $idUsuarioAux);
                        }
                    }
                }
                ?>
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Carta Actualizada</h4>
                    <p>Los nuevos platos han sido añadidos correctamente</p>
                </div>
                <?php
                header("refresh:3;url=carta.php");
            } else if (!isset($_POST['btnActualizar']) && isset($_POST['btnVolver'])) {
                header("location:index.php");
            }
            ?>
        </body>
    </html>
    <?php
}    