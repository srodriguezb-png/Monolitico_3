
<?php

require_once __DIR__ . "/../../controllers/SprintController.php";

$controlador = new SprintController($db);
// Eliminar sprint
if (isset($_GET['eliminar'])) {

    $controlador->eliminar((int) $_GET['eliminar']);

    header("Location: index.php?pagina=sprints");
    exit;
}

// Registrar sprint
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $resultado = $controlador->crear($_POST);

    if ($resultado) {
        header("Location: index.php?pagina=sprints");
        exit;
    } else {
        $error = "No se pudo registrar. Verifica los datos y las fechas.";
    }
}

// Consultar sprints
$sprints = $controlador->listar();

?>

<h1>Gestión de Sprints</h1>

<?php if (isset($error)): ?>
    <p style="color:red;">
        <?= htmlspecialchars($error) ?>
    </p>
<?php endif; ?>

<h2>Registrar nuevo Sprint</h2>

<form method="POST">

    <label>Nombre del Sprint:</label>
    <input
        type="text"
        name="nombre"
        required
    >

    <br><br>

    <label>Fecha de inicio:</label>
    <input
        type="date"
        name="fecha_inicio"
        required
    >

    <br><br>

    <label>Fecha de finalización:</label>
    <input
        type="date"
        name="fecha_fin"
        required
    >

    <br><br>

    <button type="submit">Guardar Sprint</button>

</form>

<hr>

<h2>Sprints registrados</h2>

<table border="1" cellpadding="10">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Fecha de inicio</th>
            <th>Fecha de finalización</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        <?php foreach ($sprints as $sprint): ?>

            <tr>
              <td><?= $sprint['id'] ?></td>

                <td><?= htmlspecialchars($sprint['nombre']) ?></td>

                <td><?= $sprint['fecha_inicio'] ?></td>

                <td><?= $sprint['fecha_fin'] ?></td>

            <td>
                <a href="index.php?pagina=editar_sprint&id=<?= $sprint['id'] ?>">
        Editar
            </a>

            <a
                 href="index.php?pagina=sprints&eliminar=<?= $sprint['id'] ?>"
                onclick="return confirm('¿Estás seguro de eliminar este sprint?')"
            >
        Eliminar
             </a>
            </td>
            </tr>

        <?php endforeach; ?>

        <?php if (empty($sprints)): ?>

            <tr>
                <td colspan="4">
                    No hay sprints registrados.
                </td>
            </tr>

        <?php endif; ?>

    </tbody>

</table>
