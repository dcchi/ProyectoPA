<?php
session_start();
$_SESSION['usuario'] = 1;
$_SESSION['userBuscado'] = 2;
require_once '../dao/daoPost.php';
require_once '../dao/daoMedia.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mi Galeria</title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
        <script type="text/javascript" src="/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" href="/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
        <link type="text/css" rel="stylesheet" href="../css/styleGallery.css">
        <script>
            $("[data-fancybox]").fancybox();
        </script>
    </head>
    <body>
        <h1>Galeria de fotos</h1>
        <div class="gallery">
            <?php
            $idUsuario = $_SESSION['usuario'];
            $objPost = new daoPost();
            $objMedia = new daoMedia();
            $arrayPost = $objPost->listarIdUsuario($idUsuario);
            $arrayMedia = $objMedia->listar();

            if (sizeof($arrayPost)) {
                if (sizeof($arrayMedia)) {
                    for ($i = 0; $i < sizeof($arrayPost); $i++) {
                        $postAux = $arrayPost[$i];
                        for ($j = 0; $j < sizeof($arrayMedia); $j++) {
                            $mediaAux = $arrayMedia[$j];
                            if ($postAux['idPost'] == $mediaAux['idPost']) {
                                $imgURL = "../fotoPost/" . $mediaAux['foto'];
                                ?>
                                <a href="<?php echo $imgURL; ?>" data-fancybox="gallery">
                                    <img src="<?php echo $imgURL; ?>" alt=""/>
                                </a>
                                <?php
                            }
                        }
                    }
                }
            }
            ?>
        </div>
    </body>
</html>
