<?php
include_once "novas_regras_do_portugues.php";
try {
    @$estado = $_GET["estado"];
} catch (Exception $e) {
    $estado = '';
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo getTitulo($estado). " - Novas Regras do Portugues"; ?></title>
    </head>
    <body>
        <?php echo "<h1>".getTitulo($estado)."</h1>"; echo getConteudo($estado); ?>
    </body>
</html>