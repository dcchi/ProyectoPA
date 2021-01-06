<?php
session_start();
//$_SESSION['usuario'] = 1;
if ($_SESSION['usuario']) {
    require_once '../dao/daoUsuario.php';
    require_once '../modelo/usuario.php';
    require_once '../dao/daoProfesional.php';
    require_once '../modelo/profesional.php';
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Configuración</title>
            <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
            <script type="text/javascript" src="../js/configPro.js"></script>
            <link rel="stylesheet" type="text/css" href="../css/cssCongPro.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        </head>
        <body>
            <?php
            if (!isset($_POST['btnLogin']) && !isset($_POST['btnCancelar']) && !isset($_POST['btnActualizar']) && !isset($_POST['btnVolver'])) {
                ?>
                <br/><br/>
                <div class='container'>
                    <div class='row'>
                        <div class='col'>
                        </div>
                        <div class='col'>
                            <span class='badge badge-pill badge-light'>Para ver la información de su cuenta, introduzca la contraseña</span>
                            <br/><br/>
                            <form action="configProfesional.php" method="POST">
                                <label for='password' class='label label-default'>Contraseña</label>
                                <input type="password" class='form-control' name="password" placeholder="Contraseña"/> <br>
                                <input type="submit" class="btn btn-light" name="btnLogin" value="Acceder"/>
                                <input type="submit" class="btn btn-light" name="btnCancelar" value="Volver"/> <br><br
                            </form>
                        </div>
                    </div>
                    <div class='col'></div>
                </div>
            </div>
            <?php
        } if (isset($_POST['btnLogin']) && !isset($_POST['btnCancelar']) && !isset($_POST['btnActualizar']) && !isset($_POST['btnVolver'])) {
            $idUsuario = $_SESSION['usuario'];
            $passwordAux = $_POST['password'];

            $objUsuario = new daoUsuario();
            $userBD = $objUsuario->obtenerDatos($idUsuario);
            if ($userBD) {
                $password = $userBD['password'];
                if (password_verify($passwordAux, $password)) {
                //if ($password) {
                    $objProfesional = new daoProfesional();
                    $profesionalAux = $objProfesional->obtenerDatosProfesional($idUsuario);
                    $direccion = $profesionalAux['direccion'];
                    $nombreDuenyo = $profesionalAux['nombreDuenyo'];
                    $telefono = $profesionalAux['telefono'];
                    $fechaCreacion = $profesionalAux['fechaCreacion'];
                    $foto = $profesionalAux['foto'];
                    ?>
                    <div class='container'>
                        <form action="configProfesional.php" class='form-horizontal' method="POST" enctype="multipart/form-data" onsubmit="validar()">
                            <div class='form-group'>
                                <img src="../img/<?php echo $foto ?>" alt='Foto perfil' name='fotoPerfil' id='fotoPerfil' width='150px' height="100px">
                                <input type="file" name="foto" value="null"/>
                            </div>
                            <div class='form-group'>
                                <label for="direccion">Direccion:</label>
                                <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $direccion; ?>" onfocus="conFoco('direccion')" onblur="sinFoco('direccion')" onchange="comprobarElemento('direccion')">
                            </div>
                            <div class='form-group'>
                                <label for="nombreDuenyo">Nombre del dueño:</label>
                                <input type="text" name="nombreDuenyo" id="nombreDuenyo" class="form-control" value="<?php echo $nombreDuenyo; ?>" onfocus="conFoco('nombreDuenyo')" onblur="sinFoco('nombreDuenyo')" onchange="comprobarElemento('#nombreDuenyo')">
                            </div>
                            <div class='form-group'>
                                <label for="telefono">Telefono:</label>
                                <input type="text" name="telefono" id="telefono"  class="form-control" value="<?php echo $telefono; ?>" onfocus="conFoco('telefono')" onblur="sinFoco('telefono')" onkeyup="comprobarTelefono(this)">
                            </div>
                            <div class='form-group'>
                                <label for="fechaCreacion">Fecha de creacion:</label>
                                <input type="date" name="fechaCreacion" class="form-control" id='fechaCreacion' value="<?php echo $fechaCreacion; ?>">
                            </div>
                            <div class='form-group'>
                            <input type="submit" name="btnActualizar"  class="btn btn-default" value="Actualizar"/>
                            <input type="submit" name="btnVolver" class="btn btn-default" value="Cancelar"/>
                            </div>
                        </form>
                    </div>
                    <?php
                } else {
                    header("location:configProfesional.php");
                }
            }
        } if (!isset($_POST['btnLogin']) && isset($_POST['btnCancelar']) && !isset($_POST['btnActualizar']) && !isset($_POST['btnVolver'])) {
            header("location:index.php");
        } if (!isset($_POST['btnLogin']) && !isset($_POST['btnCancelar']) && !isset($_POST['btnActualizar']) && isset($_POST['btnVolver'])) {
            header("location:index.php");
        } if (!isset($_POST['btnLogin']) && !isset($_POST['btnCancelar']) && isset($_POST['btnActualizar']) && !isset($_POST['btnVolver'])) {

            $nuevaDireccion = $_POST['direccion'];
            $nuevoNombreDuenyo = $_POST['nombreDuenyo'];
            $nuevoTelefono = $_POST['telefono'];
            $nuevaFechaCreacion = $_POST['fechaCreacion'];
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

            $nuevoProfesional = new Profesional();
            $objProfesional2 = new daoProfesional();

            $nuevoProfesional->setIdUsuario($_SESSION['usuario']);
            $nuevoProfesional->setDireccion($nuevaDireccion);
            $nuevoProfesional->setNombreDuenyo($nuevoNombreDuenyo);
            $nuevoProfesional->setTelefono($nuevoTelefono);
            $nuevoProfesional->setFechaCreacion($nuevaFechaCreacion);
            $nuevoProfesional->setFoto($nuevaFoto);

            $objProfesional2->actualizar($nuevoProfesional);
            ?>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Información Actualizada</h4>
                <p>La información ha sido actualizada correctamente</p>
            </div>
            <?php
            header("refresh:3;url=index.php");
        }
        ?>
    </body>
    </html>
    <?php
}