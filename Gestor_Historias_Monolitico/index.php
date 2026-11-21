
<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "config/conexion.php";

$conexion = new Conexion();
$db = $conexion->conectar();

$pagina = $_GET['pagina'] ?? 'inicio';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/estilos.css">
    <script src="public/js/app.js"></script>

    <title>Gestor de Historias de Usuario</title>
</head>

<body>


    <nav>
        <a href="index.php">Inicio</a> |
        <a href="index.php?pagina=sprints">Sprints</a>
        <a href="index.php?pagina=historias">Historias</a>
        <a href="index.php?pagina=informes">Informes</a>
    </nav>

    <hr>

    <?php
    if ($pagina === 'sprints') {

    require_once "views/sprints/listar.php";

    } elseif ($pagina === 'editar_sprint') {

    require_once "views/sprints/editar.php";

    } elseif ($pagina === 'historias') {

        require_once "views/historias/listar.php";

    } elseif ($pagina === 'editar_historia') {

        require_once "views/historias/editar.php";
    
    } elseif ($pagina === 'crear_historia') {

        require_once "views/historias/crear.php";

    } elseif ($pagina === 'informes') {

        require_once "views/informes/index.php";
    
    } elseif ($pagina === 'crear_sprint') {

        require_once "views/sprints/crear.php";

    } elseif ($pagina === 'crear_sprint') {

        require_once "views/sprints/crear.php";    

    } else {

    require_once "views/dashboard.php";

}
?>  

</body>

</html>
