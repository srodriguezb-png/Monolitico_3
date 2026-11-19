
<?php

require_once __DIR__ . "/../../config/conexion.php";
require_once __DIR__ . "/../../controllers/HistoriaController.php";

$conexion = new Conexion();
$db = $conexion->conectar();

$controlador = new HistoriaController($db);

$id = $_GET['id'] ?? null;

if (!$id || !ctype_digit((string)$id)) {
    die("ID de historia no válido.");
}

$historia = $controlador->buscar($id);

if (!$historia) {
    die("La historia no existe.");
}

$sprints = $db->query("SELECT * FROM sprints ORDER BY id DESC")
              ->fetchAll(PDO::FETCH_ASSOC);

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $datos = [
        'titulo' => $_POST['titulo'] ?? '',
        'descripcion' => $_POST['descripcion'] ?? '',
        'responsable' => $_POST['responsable'] ?? '',
        'puntos' => $_POST['puntos'] ?? '',
        'estado' => $_POST['estado'] ?? '',
        'sprint_id' => $_POST['sprint_id'] ?? ''
    ];

    if ($controlador->actualizar($id, $datos)) {
        echo "<script>
            window.location.href = 'index.php?pagina=historias';
        </script>";
        exit;
    } else {
        $mensaje = "No se pudieron guardar los cambios. Revisa los datos.";
    }
}
?>

<h2>Editar historia de usuario</h2>

<?php if ($mensaje !== ''): ?>
    <p><?php echo htmlspecialchars($mensaje); ?></p>
<?php endif; ?>

<form method="POST">

    <label>Título:</label><br>
    <input type="text" name="titulo"
        value="<?php echo htmlspecialchars($historia['titulo']); ?>" required>
    <br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" required><?php
        echo htmlspecialchars($historia['descripcion']);
    ?></textarea>
    <br><br>

    <label>Responsable:</label><br>
    <input type="text" name="responsable"
        value="<?php echo htmlspecialchars($historia['responsable']); ?>" required>
    <br><br>

    <label>Puntos:</label><br>
    <input type="number" name="puntos" min="1"
        value="<?php echo htmlspecialchars((string)$historia['puntos']); ?>" required>
    <br><br>

    <label>Estado:</label><br>
    <select name="estado" required>
        <?php foreach (['nueva', 'activa', 'finalizada', 'impedimento'] as $estado): ?>
            <option value="<?php echo $estado; ?>"
                <?php echo $historia['estado'] === $estado ? 'selected' : ''; ?>>
                <?php echo ucfirst($estado); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label>Sprint:</label><br>
    <select name="sprint_id" required>
        <?php foreach ($sprints as $sprint): ?>
            <option value="<?php echo $sprint['id']; ?>"
                <?php echo $historia['sprint_id'] == $sprint['id'] ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($sprint['nombre']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <button type="submit">Guardar cambios</button>
    <a href="index.php?pagina=historias">Cancelar</a>

</form>
