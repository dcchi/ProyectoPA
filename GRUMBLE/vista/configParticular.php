<?php
session_start();
$_SESSION['usuario'] = 2;
if ($_SESSION['usuario']) {
    require_once '../dao/daoUsuario.php';
    require_once '../modelo/usuario.php';
    require_once '../dao/daoParticular.php';
    require_once '../modelo/particular.php';
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Configuración</title>
            <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
            <script type="text/javascript" src="../js/configPar.js"></script>
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
                            <form action="configParticular.php" method="POST">
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
                    $objParticular = new daoParticular();
                    $particularAux = $objParticular->obtenerDatosParticular($idUsuario);
                    $nombre = $particularAux['nombre'];
                    $apellidos = $particularAux['apellidos'];
                    $sexo = $particularAux['sexo'];
                    $fechaNacimiento = $particularAux['fechaNacimiento'];
                    $foto = $particularAux['foto'];
                    $email = $userBD['email'];
                    $nickname = $userBD['nickName'];
                    ?>
                    <div class='container py-5'>
                        <div class="row">
                            <div class="col-md-10 mx-auto">
                                <form action="configParticular.php" class='form-horizontal' method="POST" enctype="multipart/form-data" onsubmit="return validar()">
                                    <div class="form-group row">
                                        <div class='col-sm-6'>
                                            <label for="fotoPerfil">Foto de perfil</label><br/>
                                            <img src="../img/<?php echo $foto ?>" alt='Foto perfil' name='fotoPerfil' id='fotoPerfil' width='150px' height="100px">
                                            <input type="file" name="foto" value="null"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">                        
                                        <div class="col-sm-6">
                                            <label for="nickName">Nickname</label>
                                            <input type="text" name="nickname" id="nickname" class="form-control" value="<?php echo $nickname; ?>" onfocus="conFoco('nickname')" onblur="sinFoco('nickname')" required="required">
                                        </div>
                                        <div class='col-sm-6'>
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre; ?>" onfocus="conFoco('nombre')" onblur="sinFoco('nombre')" onchange="comprobarElemento('#nombre')">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class='col-sm-6'>
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email" class="form-control" value="<?php echo $email; ?>" onfocus="conFoco('email')" onblur="sinFoco('email')" onchange="comprobarEmail('#email')" required="required">
                                        </div>
                                        <div class='col-sm-6'>
                                            <label for="apellidos">Apellidos</label>
                                            <input type="text" name="apellidos" id="apellidos" class="form-control" value="<?php echo $apellidos; ?>" onfocus="conFoco('apellidos')" onblur="sinFoco('apellidos')" onchange="comprobarElemento('#apellidos')">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class='col-sm-6'>
                                            <label for="nuevaPass">Nueva contraseña</label>
                                            <input type="password" name="nuevaPass" id="nuevaPass" class="form-control" value="" onchange="seguridadPassword('nuevaPass')">
                                        </div>
                                        <div class='col-sm-6'>
                                            <label for="sexo">Sexo</label><br/>
                                            <select id="sexo" name="sexo" class="form-control">
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                                <option value="O">Otro</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class='col-sm-6'>
                                            <label for="confPass">Confirmar contraseña</label>
                                            <input type="password" name="confPass" id="confPass" class="form-control" onfocus="conFoco('confPass')" onblur="sinFoco('confPass')" onchange="comprobarPassword('#confPass')">
                                        </div>
                                        <div class='col-sm-6'>
                                            <label for="fechaCreacion">Fecha de nacimiento</label>
                                            <input type="date" name="fechaNacimiento" class="form-control" id='fechaNacimiento' value="<?php echo $fechaNacimiento; ?>" onchange="esFechaFutura('#fechaNacimiento')">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class='col-sm-6'>
                                            <input type="submit" name="btnActualizar"  class="btn btn-default" value="Actualizar"/>
                                            <input type="submit" name="btnVolver" class="btn btn-default" value="Cancelar"/>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </form>
                </div>

                <?php
            } else {
                header("location:configParticular.php");
            }
        }
    } if (!isset($_POST['btnLogin']) && isset($_POST['btnCancelar']) && !isset($_POST['btnActualizar']) && !isset($_POST['btnVolver'])) {
        header("location:index.php");
    } if (!isset($_POST['btnLogin']) && !isset($_POST['btnCancelar']) && !isset($_POST['btnActualizar']) && isset($_POST['btnVolver'])) {
        header("location:index.php");
    } if (!isset($_POST['btnLogin']) && !isset($_POST['btnCancelar']) && isset($_POST['btnActualizar']) && !isset($_POST['btnVolver'])) {

        $nuevoNombre = $_POST['nombre'];
        $nuevosApellidos = $_POST['apellidos'];
        $nuevoSexo = $_POST['sexo'];
        $nuevaFechaNacimiento = $_POST['fechaNacimiento'];
        $nuevoNickName = $_POST['nickname'];
        $nuevoEmail = $_POST['email'];
        $nuevaPassword = $_POST['nuevaPass'];

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

        $nuevoParticular = new Particular();
        $objParticular = new daoParticular();
        $nuevoUsuario = new Usuario();
        $objUsuario = new daoUsuario();

        if ($nuevaPassword != null) {
            $claveHash = password_hash($nuevaPassword, PASSWORD_DEFAULT);

            $nuevoUsuario->setIdUsuario($_SESSION['usuario']);
            $nuevoUsuario->setNick($nuevoNickName);
            $nuevoUsuario->setEmail($nuevoEmail);
            $nuevoUsuario->setPassword($claveHash);
        } else {
            $nuevoUsuario->setIdUsuario($_SESSION['usuario']);
            $nuevoUsuario->setNick($nuevoNickName);
            $nuevoUsuario->setEmail($nuevoEmail);
            $nuevoUsuario->setPassword("");
        }

        $objUsuario->actualizar($nuevoUsuario);

        $nuevoParticular->setIdUsuario($_SESSION['usuario']);
        $nuevoParticular->setNombre($nuevoNombre);
        $nuevoParticular->setApellidos($nuevosApellidos);
        $nuevoParticular->setSexo($nuevoSexo);
        $nuevoParticular->setFechaNacimiento($nuevaFechaNacimiento);
        $nuevoParticular->setFoto($nuevaFoto);

        $objParticular->actualizar($nuevoParticular);
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