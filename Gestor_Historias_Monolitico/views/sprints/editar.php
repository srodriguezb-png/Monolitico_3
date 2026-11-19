
<?php

require_once __DIR__ . "/../../controllers/SprintController.php";

$controlador = new SprintController($db);

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sprint = $controlador->buscar($id);

if (!$sprint) {
    die("Sprint no encontrado");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $resultado = $controlador->actualizar($id, $_POST);

    if ($resultado) {
        header("Location: index.php?pagina=sprints");
        exit;
    } else {
        $error = "No se pudo actualizar el sprint. Revisa los datos.";
    }
}

?>

<h1>Editar Sprint</h1>

<?php if (isset($error)): ?>
    <p style="color:red;">
        <?= htmlspecialchars($error) ?>
    </p>
<?php endif; ?>

<form method="POST">

    <label>Nombre del Sprint:</label>

    <input
        type="text"
        name="nombre"
        value="<?= htmlspecialchars($sprint['nombre']) ?>"
        required
    >

    <br><br>

    <label>Fecha de inicio:</label>

    <input
        type="date"
        name="fecha_inicio"
        value="<?= $sprint['fecha_inicio'] ?>"
        required
    >

    <br><br>

    <label>Fecha de finalización:</label>

    <input
        type="date"
        name="fecha_fin"
        value="<?= $sprint['fecha_fin'] ?>"
        required
    >

    <br><br>

    <button type="submit">Actualizar Sprint</button>

    <a href="index.php?pagina=sprints">Cancelar</a>

</form>
