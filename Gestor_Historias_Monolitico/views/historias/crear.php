
<?php

require_once __DIR__ . "/../../controllers/HistoriaController.php";

$controlador = new HistoriaController($db);

// Consultar sprints disponibles
$consulta = $db->query("SELECT * FROM sprints ORDER BY id DESC");
$sprints = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Guardar historia
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($controlador->crear($_POST)) {

        header("Location: index.php?pagina=historias");
        exit;

    } else {

        $error = "No se pudo registrar. Verifica los datos.";

    }
}

?>

<h1>Registrar Historia de Usuario</h1>

<?php if (isset($error)): ?>
    <p style="color:red;">
        <?= htmlspecialchars($error) ?>
    </p>
<?php endif; ?>

<?php if (empty($sprints)): ?>

    <p>Primero debes registrar un sprint.</p>

    <a href="index.php?pagina=sprints">Ir a Sprints</a>

<?php else: ?>

<form method="POST">

    <label>Título:</label><br>
    <input type="text" name="titulo" required>

    <br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" required></textarea>

    <br><br>

    <label>Responsable:</label><br>
    <input type="text" name="responsable" required>

    <br><br>

    <label>Puntos de complejidad:</label><br>
    <input type="number" name="puntos" min="1" required>

    <br><br>

    <label>Estado:</label><br>

    <select name="estado" required>
        <option value="nueva">Nueva</option>
        <option value="activa">Activa</option>
        <option value="finalizada">Finalizada</option>
        <option value="impedimento">En impedimento</option>
    </select>

    <br><br>

    <label>Fecha de creación:</label><br>
    <input
        type="date"
        name="fecha_creacion"
        value="<?= date('Y-m-d') ?>"
        required
    >

    <br><br>

    <label>Seleccionar Sprint:</label><br>

    <select name="sprint_id" required>

        <option value="">Seleccionar Sprint</option>

        <?php foreach ($sprints as $sprint): ?>

            <option value="<?= $sprint['id'] ?>">
                <?= htmlspecialchars($sprint['nombre']) ?>
            </option>

        <?php endforeach; ?>

    </select>

    <br><br>

    <button type="submit">Guardar Historia</button>

    <a href="index.php?pagina=historias">Cancelar</a>

</form>

<?php endif; ?>
