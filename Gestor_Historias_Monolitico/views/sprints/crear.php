
<?php

require_once __DIR__ . "/../../controllers/SprintController.php";

$controlador = new SprintController($db);

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $resultado = $controlador->crear($_POST);

    if ($resultado) {
        echo "<script>
            window.location.href = 'index.php?pagina=sprints';
        </script>";
        exit;
    } else {
        $error = "No se pudo registrar el Sprint. Verifica los datos y las fechas.";
    }
}

?>

<h1>Registrar nuevo Sprint</h1>

<?php if ($error !== ''): ?>
    <p style="color:red;">
        <?= htmlspecialchars($error) ?>
    </p>
<?php endif; ?>

<form method="POST">

    <label>Nombre del Sprint:</label><br>
    <input type="text" name="nombre" required maxlength="100">

    <br><br>

    <label>Fecha de inicio:</label><br>
    <input type="date" name="fecha_inicio" required>

    <br><br>

    <label>Fecha de finalización:</label><br>
    <input type="date" name="fecha_fin" required>

    <br><br>

    <button type="submit">Guardar Sprint</button>

    <a href="index.php?pagina=sprints">Cancelar</a>

</form>

